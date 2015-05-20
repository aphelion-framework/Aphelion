<?php

namespace Application\Controller\Nested;

use Aphelion\Router\Annotation as Route;

/**
 * @Route\Name("nested")
 */
class IndexController
{
    /**
     * @Route\Name("index")
     * @Route\Route("/nested")
     */
    public function indexAction()
    {

    }

    /**
     * @Route\Name("foo")
     * @Route\Route("/nested/foo/:id[/]", {"constraints":{"id": "[0-9]+"}})
     * @Route\Method("GET")
     */
    public function fooAction($id)
    {

    }

    /**
     * @Route\Name("foo")
     * @Route\Route("/nested/foo/:id[/]", {"constraints":{"id": "[0-9]+"}})
     * @Route\Method("POST")
     */
    public function fooPostAction($id)
    {

    }
}
