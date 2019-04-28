<?php

namespace Http;

class Request
{
    private $uri;
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
        $this->setUriComponents($_SERVER['REQUEST_URI']);
    }

    protected function setHttpMethod($httpMethod)
    {
        if (!in_array($httpMethod, self::SUPPORTED_METHODS)) {
            throw new \InvalidArgumentException('Unsupported HTTP request method ' . $httpMethod . ' was given.');
        }
        $this->httpMethod = $httpMethod;
    }

    protected function setUriComponents($requestUri)
    {
        $uriComponents = parse_url($requestUri);

        //todo
    }

    protected function setParam($key, $value)
    {
        $this->params[$key] = $value;
    }

    public function getUri()
    {
        return $this->uri;
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