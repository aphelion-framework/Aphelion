<?php

namespace Aphelion\Router;

/**
 * Router
 */
class Router/* implements RouterInterface */
{
    /**
     * @var array
     */
    private $routes = [];

    /**
     * @var RouteMatch
     */
    private $matchedRoute;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function match($uri, $method)
    {
        /** @var Route $route */
        foreach ($this->routes as $route) {

            if ($route->matches($uri, $method)) {

                $this->matchedRoute = new RouteMatch();
                $this->matchedRoute->setRoute($route);
                $this->matchedRoute->setParams($route->getParams());

                return true;
            }
        }

        return false;
    }

    /**
     * @return RouteMatch
     */
    public function getMatchedRoute()
    {
        return $this->matchedRoute;
    }
}
