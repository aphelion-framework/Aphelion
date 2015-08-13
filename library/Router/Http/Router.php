<?php

namespace Aphelion\Router\Http;

use Aphelion\Http\Request;
use Aphelion\Router\Http\Route\Builder;
use Aphelion\Router\Http\Route\Route;

/**
 * Router
 *
 * @author Rob Caiger <rob@clocal.co.uk>
 */
class Router
{
    /**
     * @var Route[]
     */
    private $routes = [];

    /**
     * Load routes from the given file
     *
     * @param $path
     */
    public function loadRoutes($path)
    {
        if (!file_exists($path)) {
            throw new \RuntimeException('Router: ' . $path . ' file does not exists');
        }

        $router = $this;

        require_once($path);
    }

    /**
     * @param Request $request
     * @return Route|bool
     */
    public function route(Request $request)
    {
        /** @var Route $route */
        foreach ($this->routes as $route) {
            if ($route->matches($request->getUri(), $request->getMethod())) {
                return $route;
            }
        }

        return false;
    }

    /**
     * @return Builder
     */
    public function when($uri)
    {
        $route = new Route();
        $route->setRoute($uri);

        $this->routes[] = $route;

        return new Builder($route);
    }
}
