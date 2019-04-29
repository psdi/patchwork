<?php

namespace Http;

class Request
{
    /** @var string $requestUri */
    private $requestUri;
    /** @var string $httpMethod */
    private $httpMethod;
    /** @var array $params */
    private $params = [];

    const SUPPORTED_METHODS = [
        'GET',
        'POST',
    ];

    public function __construct()
    {
        $this->setHttpMethod($_SERVER['REQUEST_METHOD']);
        $this->setRequestUri($_SERVER['REQUEST_URI']);
    }

    protected function setHttpMethod($httpMethod)
    {
        if (!in_array($httpMethod, self::SUPPORTED_METHODS)) {
            throw new \InvalidArgumentException('Unsupported HTTP request method ' . $httpMethod . ' was given.');
        }
        $this->httpMethod = $httpMethod;
    }

    protected function setRequestUri($requestUri)
    {
        $this->requestUri = $requestUri;
    }

    protected function setParam($key, $value)
    {
        $this->params[$key] = $value;
    }

    public function getRequestUri()
    {
        return $this->requestUri;
    }

    public function getHttpMethod()
    {
        return $this->httpMethod;
    }

    public function getParam($key)
    {
        if (!isset($this->params[$key])) {
            throw new \InvalidArgumentException('The request key ' . $key . ' does not exist.');
        }
        return $this->params[$key];
    }

    public function getAllParams()
    {
        return $this->params;
    }
}