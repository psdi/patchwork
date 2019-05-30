<?php

namespace Routing;

class Route
{
    public $regexPattern = '';
    public $httpMethod = '';
    public $callable = null;
    public $handler = [];
    public $params = [];
    public $routeWithParams = '';

    /**
     * Route constructor - accepts either a handler or an anonymous function
     * 
     * @var string $regexPattern
     * @var string $httpMethod
     * @var callable|array $handler
     * @var array $params
     * @var string $routeWithParams
     */
    public function __construct($regexPattern, $httpMethod, $handler, $params = [], $routeWithParams = '')
    {
        $this->regexPattern = $regexPattern;
        $this->httpMethod = $httpMethod;
        if (is_callable($handler)) {
            $this->callable = $handler;
        } else if (is_array($handler)) {
            $this->handler = $handler;
        }
        $this->params = $params;    
        $this->routeWithParams = $routeWithParams;
    }

    public function compare($pattern)
    {
        $regexPattern = '~^' . $this->regexPattern . '$~';
        return (bool) preg_match($regexPattern, $pattern);
    }
}
