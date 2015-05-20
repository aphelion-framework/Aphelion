<?php

namespace Application;

/**
 * Application Module
 */
class Module implements \Aphelion\Application\ModuleInterface
{
    public function onBootstrap()
    {

    }

    public function getConfig()
    {
        return include(__DIR__ . '/config/module.config.php');
    }
}
