<?php

namespace Application\Controller;

use Aphelion\Router\Annotation as Route;

/**
 * @Route\Name("home")
 */
class IndexController
{
    /**
     * @Route\Name("index")
     * @Route\Route("/")
     */
    public function indexAction()
    {

    }

    /**
     * @Route\Name("foo")
     * @Route\Route("/foo/:id[/]", {"constraints":{"id": "[0-9]+"}})
     * @Route\Method("GET")
     */
    public function fooAction($id)
    {

    }

    /**
     * @Route\Name("foo")
     * @Route\Route("/foo/:id[/]", {"constraints":{"id": "[0-9]+"}})
     * @Route\Method("POST")
     */
    public function fooPostAction($id)
    {

    }
}
