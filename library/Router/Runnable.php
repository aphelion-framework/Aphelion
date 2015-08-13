<?php

namespace Aphelion\Router;

/**
 * Runnable
 *
 * @author Rob Caiger <rob@clocal.co.uk>
 */
class Runnable
{
    private $runner;

    public function __construct($runner)
    {
        $this->runner = $runner;
    }

    public function run($params)
    {
        if (!is_callable($this->runner)) {
            throw new \RuntimeException('Cant call runner');
        }

        return call_user_func_array($this->runner, $params);
    }
}
