<?php

namespace Aphelion\Application;

use Aphelion\Router\AnnotationBuilder;
use Aphelion\Router\Router;
use Composer\Autoload\ClassLoader;
use Doctrine\Common\Annotations\AnnotationRegistry;

/**
 * Application class
 */
class Application
{
    /**
     * @var ConfigInterface
     */
    private $config;

    /**
     * @var ClassLoader
     */
    private $loader;

    /**
     * @var array
     */
    private $modules = [];

    public function run(ConfigInterface $config, ClassLoader $loader)
    {
        $this->config = $config;
        $this->loader = $loader;

        $this->loadModules($config->getModules());

        $this->router = new Router($this->loadRoutes());

        $uri = filter_input(INPUT_SERVER, 'REQUEST_URI');

        list($uri) = explode('?', $uri);

        if ($this->router->match($uri)) {
            $matchedRoutes = $this->router->getMatchedRoutes();
        } else {
            // 404
            die('404');
        }
    }

    /**
     * @TODO Cache these routes
     */
    private function loadRoutes()
    {
        $routes = [];

        $paths = $this->config->getControllerPaths();

        $controllers = [];

        foreach ($paths as $path) {
            $controllers = array_merge($controllers, $this->findFqcns($path));
        }

        // @todo tidy this up
        AnnotationRegistry::registerLoader(
            array($this->loader, 'loadClass')
        );

        $annotationBuilder = new AnnotationBuilder();

        foreach ($controllers as $controllerClass) {
            $annotationBuilder->createRoute($controllerClass);
        }

        return $routes;
    }

    private function findFqcns($path)
    {
        $fqcns = array();

        $allFiles = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));

        foreach ($allFiles as $file) {
            $content = file_get_contents($file->getRealPath());
            $tokens = token_get_all($content);
            $namespace = '';
            for ($index = 0; isset($tokens[$index]); $index++) {
                if (!isset($tokens[$index][0])) {
                    continue;
                }
                if (T_NAMESPACE === $tokens[$index][0]) {
                    $index += 2; // Skip namespace keyword and whitespace
                    while (isset($tokens[$index]) && is_array($tokens[$index])) {
                        $namespace .= $tokens[$index++][1];
                    }
                }
                if (T_CLASS === $tokens[$index][0]) {
                    $index += 2; // Skip class keyword and whitespace
                    $fqcns[] = $namespace.'\\'.$tokens[$index][1];
                }
            }
        }

        return $fqcns;
    }

    private function loadModules(array $modules)
    {
        foreach ($modules as $namespace => $path) {

            $namespace = rtrim($namespace, '\\') . '\\';

            $this->loader->addPsr4($namespace, $path);

            $moduleClass = $namespace . 'Module';

            /** @var ModuleInterface $module */
            $module = new $moduleClass();
            $module->onBootstrap();

            $this->config->merge($module->getConfig());

            $this->modules[$namespace] = $module;
        }
    }
}
