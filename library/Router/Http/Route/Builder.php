<?php

namespace Aphelion\Router\Http\Route;
use Aphelion\Router\Runnable;

/**
 * Router Builder
 *
 * @author Rob Caiger <rob@clocal.co.uk>
 */
class Builder
{
    /**
     * @var Route
     */
    private $route;

    public function __construct(Route $route)
    {
        $this->route = $route;
    }

    /**
     * @return Route
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @return Builder
     */
    public function post()
    {
        return $this->create();
    }

    /**
     * @return Builder
     */
    public function create()
    {
        $this->route->addMethod(Route::METHOD_POST);

        return $this;
    }

    public function get()
    {
        return $this->read();
    }

    /**
     * @return Builder
     */
    public function read()
    {
        $this->route->addMethod(Route::METHOD_GET);

        return $this;
    }

    public function put()
    {
        return $this->update();
    }

    /**
     * @return Builder
     */
    public function update()
    {
        $this->route->addMethod(Route::METHOD_PUT);

        return $this;
    }

    /**
     * @return Builder
     */
    public function delete()
    {
        $this->route->addMethod(Route::METHOD_DELETE);

        return $this;
    }

    /**
     * @param $name
     * @return $this
     */
    public function knownAs($name)
    {
        $this->route->setName($name);

        return $this;
    }

    /**
     * @param $runner
     * @return $this
     */
    public function run($runner)
    {
        $runnable = new Runnable($runner);

        $this->route->setRunnable($runnable);

        return $this;
    }
}
