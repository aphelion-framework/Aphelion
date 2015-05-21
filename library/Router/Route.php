<?php

namespace Aphelion\Router;

/**
 * Route
 */
class Route/* implements RouteInterface */
{
    private $name;

    private $methods = [];

    private $route;

    private $constraints;

    private $controller;

    private $action;

    private $regex;

    private $params = [];

    private $possibleParams = [];

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getMethods()
    {
        return $this->methods;
    }

    /**
     * @param mixed $methods
     */
    public function addMethod($method)
    {
        $method = strtoupper($method);
        $this->methods[$method] = $method;
    }

    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param mixed $route
     */
    public function setRoute($route)
    {
        $this->route = $route;
    }

    /**
     * @return mixed
     */
    public function getConstraints()
    {
        return $this->constraints;
    }

    /**
     * @param mixed $constraints
     */
    public function setConstraints($constraints)
    {
        $this->constraints = $constraints;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @param mixed $controller
     */
    public function setController($controller)
    {
        $this->controller = $controller;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    public function matches($uri, $method)
    {
        if (!$this->matchMethod($method)) {
            return false;
        }

        $regex = $this->getRegex();

        if (!preg_match('/^' . $regex . '$/', $uri, $matches)) {
            return false;
        }

        $this->params = [];
        foreach ($matches as $param => $value) {

            if (!is_numeric($param) && in_array($param, $this->possibleParams)) {

                $this->params[$param] = $value;
            }
        }

        return true;
    }

    public function getParams()
    {
        $params = [];

        foreach ($this->possibleParams as $param) {
            $params[$param] = isset($this->params[$param]) ? $this->params[$param] : null;
        }

        return $params;
    }

    protected function matchMethod($method)
    {
        if (empty($this->methods)) {
            return true;
        }

        return in_array(strtoupper($method), $this->methods);
    }

    protected function getRegex()
    {
        if ($this->regex === null) {
            $regex = $this->route;

            $regex = str_replace('/', '\\/', $regex);
            $regex = $this->replaceOptional($regex);
            $regex = $this->replaceParams($regex);

            $this->regex = $regex;
        }

        return $this->regex;
    }

    protected function replaceOptional($regex)
    {
        if (preg_match_all('/\[([^\]]+)\]/', $regex, $matches)) {
            foreach ($matches[0] as $index => $replacement) {
                $replaceInside = $matches[1][$index];

                $regex = str_replace($replacement, '(' . $replaceInside . ')?', $regex);
            }
        }

        return $regex;
    }

    protected function replaceParams($regex)
    {
        if (preg_match_all('/\(\:([a-zA-Z\_]+)\)/', $regex, $matches)) {
            foreach ($matches[0] as $index => $replacement) {
                $paramName = $matches[1][$index];

                $this->possibleParams[] = $paramName;

                if (array_key_exists($paramName, $this->constraints)) {
                    $constraint = $this->constraints[$paramName];
                } else {
                    $constraint = '[^\/]+';
                }

                $regex = str_replace(
                    $replacement,
                    '(?P<' . $paramName . '>' . $constraint . ')',
                    $regex
                );
            }
        }

        return $regex;
    }
}
