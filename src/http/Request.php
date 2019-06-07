<?php

namespace Http;

class Request
{
    /** @var mixed[] */
    public $attributes = [];
    /** @var mixed[] */
    private $params = [];

    const SUPPORTED_METHODS = [
        'GET',
        'POST',
    ];

    public function __construct()
    {
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        if (!in_array($httpMethod, self::SUPPORTED_METHODS)) {
            throw new \InvalidArgumentException('Unsupported HTTP request method ' . $httpMethod . ' was given.');
        }
        $this->setAttribute('httpMethod', $httpMethod);
        $this->setAttribute('requestUri', rtrim($_SERVER['REQUEST_URI'], '/'));
    }

    public function getAttribute($name)
    {
        if (!isset($this->attributes[$name])) {
            return false;
        }
        return $this->attributes[$name];
    }

    public function setAttribute($name, $value)
    {
        $this->attributes[$name] = $value;
        return $this;
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