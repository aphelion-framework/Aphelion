<?php

namespace Aphelion\Router;

/**
 * Route Match
 */
class RouteMatch/* implements RouteMatchInterface */
{
    /**
     * @var Route
     */
    private $route;

    private $params;

    /**
     * @return Route
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
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param mixed $params
     */
    public function setParams($params)
    {
        $this->params = $params;
    }
}
