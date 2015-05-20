<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

$loader = require(__DIR__ . '/../vendor/autoload.php');

(new \Aphelion\Application\Application())->run(include(__DIR__ . '/../config/application.config.php'), $loader);
