<?php

namespace Aphelion;

use Aphelion\Http\Request;

/**
 * Application
 *
 * @author Rob Caiger <rob@clocal.co.uk>
 */
class Application
{
    private static $instance;

    /**
     * @var Router\Http\Router
     */
    private $router;

    /**
     * @var Request
     */
    private $request;

    /**
     * Private to prevent instantiation
     */
    private function __construct()
    {
        $this->setup();
    }

    /**
     * Return the same single instance of the Application
     *
     * @return Application
     */
    public static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return Router\Http\Router
     */
    public function getRouter()
    {
        return $this->router;
    }

    /**
     * @param Router\Http\Router $router
     */
    public function setRouter(Router\Http\Router $router)
    {
        $this->router = $router;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param Request $request
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Run the application
     */
    public function run()
    {
        $this->setupRouter();

        $route = $this->getRouter()->route($this->getRequest());

        // @todo sort this out
        echo $route->run();
        exit;
    }

    /**
     * Setup the application
     */
    private function setUp()
    {
        $this->setRequest(new Request());
        $this->setRouter(new Router\Http\Router($this->getRequest()));
    }

    /**
     * Setup the router
     */
    private function setupRouter()
    {
        $this->router->loadRoutes(APP_ROUTE . '/routes/http.php');
    }
}
