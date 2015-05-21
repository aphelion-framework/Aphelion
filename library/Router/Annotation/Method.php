<?php

namespace Aphelion\Router\Annotation;

/**
 * @Annotation
 */
class Method
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getMethod()
    {
        return $this->data['value'];
    }
}
