<?php

/** @var \Aphelion\Router\Http\Router $router */
$router->when('/')->read()->knownAs('home')->run(function () {
    return 'foo';
});

$router->when('/home')->read()->knownAs('home')->run(function () {
    return 'home';
});