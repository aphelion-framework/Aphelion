<?php

namespace Aphelion\Application;

use Aphelion\Exception\RuntimeException;

/**
 * Config
 */
final class Config implements ConfigInterface
{
    private $config;

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    public function merge(ConfigInterface $config)
    {
        $this->config = array_merge_recursive($this->config, $config->toArray());
    }

    public function toArray()
    {
        return $this->config;
    }

    /**
     * @return array
     * @throws RuntimeException
     */
    public function getModules()
    {
        if (!empty($this->config['modules']) && is_array($this->config['modules'])) {

            return $this->config['modules'];
        }

        throw new RuntimeException('No modules to load');
    }

    public function getControllerPaths()
    {
        if (isset($this->config['controllers']['paths'])) {
            return $this->config['controllers']['paths'];
        }

        return [];
    }
}
