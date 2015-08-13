<?php

namespace Aphelion\Http;

/**
 * Request
 *
 * @author Rob Caiger <rob@clocal.co.uk>
 */
class Request
{
    /**
     * @var string
     */
    private $uri;

    /**
     * @var string
     */
    private $method;

    public function __construct()
    {
        $uri = filter_input(INPUT_SERVER, 'REQUEST_URI');
        list($this->uri) = explode('?', $uri);

        $this->method = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }
}
