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
        die('index - index');
    }

    /**
     * @Route\Name("blog")
     * @Route\Route("/blog[/(:id)][/(:title)][/]", {"constraints":{"id": "[0-9]+"}})
     * @Route\Method("GET")
     */
    public function blogAction($id = null, $title = null)
    {
        die('index - blog - ' . $id . ' - ' . $title);
    }

    /**
     * @Route\Name("foo")
     * @Route\Route("/foo/(:id)[/]", {"constraints":{"id": "[0-9]+"}})
     * @Route\Method("GET")
     */
    public function fooAction($id)
    {

        die('index - foo - ' . $id);
    }

    /**
     * @Route\Name("foo")
     * @Route\Route("/foo/(:id)[/]", {"constraints":{"id": "[0-9]+"}})
     * @Route\Method("POST")
     */
    public function fooPostAction($id)
    {
        die('index - foo - post - ' . $id);
    }
}
