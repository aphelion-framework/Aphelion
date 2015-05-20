<?php

namespace Aphelion\Application;

/**
 * Module Interface
 */
interface ModuleInterface
{
    public function onBootstrap();

    public function getConfig();
}
