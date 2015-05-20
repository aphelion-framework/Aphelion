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
     * @var array
     */
    private $matchedRoutes = [];

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function match($uri)
    {
        $this->matchedRoutes = [];

        foreach ($this->routes as $route) {
            if ($route->matches($uri)) {
                $this->matchedRoutes[] = $route;
            }
        }

        return !empty($this->matchedRoutes);
    }

    public function getMatchedRoutes()
    {
        return $this->matchedRoutes;
    }
}
