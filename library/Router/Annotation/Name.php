<?php

namespace Aphelion\Router\Annotation;

/**
 * @Annotation
 */
class Name
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getName()
    {
        return $this->data['value'];
    }
}
