<?php

namespace Aphelion\Router;

use Doctrine\Common\Annotations\AnnotationReader;

/**
 * Annotation Builder
 */
class AnnotationBuilder
{
    protected $reader;

    public function setReader(AnnotationReader $reader)
    {
        $this->reader = $reader;
    }

    public function getReader()
    {
        if ($this->reader === null) {
            $this->setReader(new AnnotationReader());
        }

        return $this->reader;
    }

    public function createRoute($class)
    {
        $reflected = new \ReflectionClass($class);

        $classAnnotations = $this->getReader()->getClassAnnotations($reflected);

        var_dump($classAnnotations);

        foreach ($reflected->getProperties() as $property) {

        }
    }
}
