<?php

namespace Http;

class Request
{
    /** @var string */
    private $requestUri;
    /** @var string */
    private $httpMethod;
    /** @var callable|callable[]|\Closure */
    private $handler;
    /** @var mixed[] */
    private $params = [];

    const SUPPORTED_METHODS = [
        'GET',
        'POST',
    ];

    public function __construct()
    {
        $this->setHttpMethod($_SERVER['REQUEST_METHOD']);
        $this->setRequestUri(rtrim($_SERVER['REQUEST_URI'], '/'));
    }

    public function getRequestUri()
    {
        return $this->requestUri ?? '';
    }

    protected function setRequestUri($requestUri)
    {
        $this->requestUri = $requestUri;
    }

    public function getHttpMethod()
    {
        return $this->httpMethod ?? '';
    }

    protected function setHttpMethod($httpMethod)
    {
        if (!in_array($httpMethod, self::SUPPORTED_METHODS)) {
            throw new \InvalidArgumentException('Unsupported HTTP request method ' . $httpMethod . ' was given.');
        }
        $this->httpMethod = $httpMethod;
    }

    public function getHandler()
    {
        return $this->handler;
    }

    public function setHandler($handler)
    {
        $this->handler = $handler;
        //todo: add a fallback/error Controller
    }

    public function getParam($key)
    {
        if (!isset($this->params[$key])) {
            throw new \InvalidArgumentException('The requested key ' . $key . ' does not exist.');
        }
        return $this->params[$key];
    }

    public function setParam($key, $value)
    {
        $this->params[$key] = $value;
    }

    public function getAllParams()
    {
        return $this->params;
    }
}