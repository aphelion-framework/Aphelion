<?php

return new \Aphelion\Application\Config([
    // Stores a list of modules to load
    'modules' => [
        // Namespace => /path/to/module/root
        'Application\\' => __DIR__ . '/../modules/Application'
    ]
]);
