<?php

namespace Aphelion\Router;

use Aphelion\Router\Annotation;
use Doctrine\Common\Annotations\AnnotationReader;

/**
 * Annotation Builder
 */
class AnnotationBuilder
{
    /**
     * @var AnnotationReader
     */
    protected $reader;

    public function setReader(AnnotationReader $reader)
    {
        $this->reader = $reader;
    }


    /**
     * @return AnnotationReader
     */
    public function getReader()
    {
        if ($this->reader === null) {
            $this->setReader(new AnnotationReader());
        }

        return $this->reader;
    }

    public function createRoutes($class)
    {
        $routes = [];

        $reflected = new \ReflectionClass($class);

        $classAnnotations = $this->getReader()->getClassAnnotations($reflected);

        $name = null;
        foreach ($classAnnotations as $annotation) {
            if ($annotation instanceof Annotation\Name) {
                $name = $annotation->getName();
            }
        }

        foreach ($reflected->getMethods() as $method) {
            $annotations = $this->getReader()->getMethodAnnotations($method);

            $route = new Route();
            $route->setController($class);
            $route->setAction($method->getName());

            foreach ($annotations as $annotation) {
                if ($annotation instanceof Annotation\Name) {
                    $routeName = trim($name . '/' . $annotation->getName(), '/');
                    $route->setName($routeName);
                }

                if ($annotation instanceof Annotation\Method) {
                    $route->addMethod($annotation->getMethod());
                }

                if ($annotation instanceof Annotation\Route) {
                    $route->setRoute($annotation->getRoute());
                    $route->setConstraints($annotation->getConstraints());
                }
            }

            $routes[] = $route;
        }

        return $routes;
    }
}
