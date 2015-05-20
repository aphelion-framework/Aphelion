<?php

namespace Aphelion\Application;

use Aphelion\Exception\RuntimeException;

/**
 * Config Interface
 */
interface ConfigInterface
{
    /**
     * @return array
     * @throws RuntimeException
     */
    public function getModules();

    /**
     * @return array
     */
    public function getControllerPaths();

    public function merge(ConfigInterface $config);

    public function toArray();
}
