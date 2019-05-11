<?php

namespace Http;

class Request
{
    /** @var string $requestUri */
    private $requestUri;
    /** @var string $httpMethod */
    private $httpMethod;
    /** @var string $controller */
    private $controller;
    /** @var string $action */
    private $action;
    /** @var array $params */
    private $params = [];
    /** @var callable $callable */
    private $callable = null;

    const SUPPORTED_METHODS = [
        'GET',
        'POST',
    ];

    public function __construct()
    {
        $this->setHttpMethod($_SERVER['REQUEST_METHOD']);
        $this->setRequestUri($_SERVER['REQUEST_URI']);
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

    public function getController()
    {
        return $this->controller ?? '';
    }

    public function getAction()
    {
        return $this->action ?? '';
    }

    public function setHandler(array $handler)
    {
        $controller = (strpos($handler[0], 'Controller') !== false) ? $handler[0] : 'ErrorController';
        // todo: create ErrorController
        $action = (strpos($handler[1], 'Action') !== false) ? $handler[1] : 'throwAction';
        $this->controller = $controller;
        $this->action = $action;
    }

    public function getParam($key)
    {
        if (!isset($this->params[$key])) {
            throw new \InvalidArgumentException('The request key ' . $key . ' does not exist.');
        }
        return $this->params[$key];
    }

    protected function setParam($key, $value)
    {
        $this->params[$key] = $value;
    }

    public function getAllParams()
    {
        return $this->params;
    }

    public function getCallable()
    {
        return $this->callable;
    }

    public function setCallable($callable)
    {
        if (is_callable($callable)) {
            $this->callable = $callable;
        }
    }
}