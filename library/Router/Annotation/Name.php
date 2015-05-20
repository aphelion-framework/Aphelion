<?php

namespace Aphelion\Router\Annotation;

/**
 * @Annotation
 */
class Name
{
    public function __construct(array $data)
    {
        var_dump($data);
    }
}
