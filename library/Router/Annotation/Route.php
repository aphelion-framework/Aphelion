<?php

namespace Aphelion\Router\Annotation;

/**
 * @Annotation
 */
class Route
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getRoute()
    {
        if (is_array($this->data['value'])) {
            return $this->data['value'][0];
        }

        return $this->data['value'];
    }

    public function getConstraints()
    {
        if (isset($this->data['value'][1]['constraints'])) {
            return $this->data['value'][1]['constraints'];
        }

        return [];
    }
}
