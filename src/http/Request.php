<?php

namespace Http;

class Request
{
    private $uri;
    private $httpMethod;
    private $params;

    const SUPPORTED_METHODS = [
        'GET',
        'POST',
    ];

    public function __construct()
    {
        $this->setHttpMethod($_SERVER['REQUEST_METHOD']);
    }

    protected function setHttpMethod($httpMethod)
    {
        if (in_array($httpMethod, self::SUPPORTED_METHODS)) {
            $this->httpMethod = $httpMethod;
        }
        throw new \InvalidArgumentException('Unsupported HTTP request method ' . $httpMethod . ' was given.');
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getHttpMethod()
    {
        return $this->httpMethod;
    }

    public function getParams()
    {
        return $this->params;
    }
}