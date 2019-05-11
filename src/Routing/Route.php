<?php

namespace Routing;

class Route
{
    public $pattern = '';
    public $httpMethod = '';
    public $callable = null;
    public $handler = [];
    public $params = [];

    /**
     * Route constructor - accepts either a handler or an anonymous function
     * 
     * @var string $pattern
     * @var string $httpMethod
     * @var callable|array $handler
     * @var array $params
     */
    public function __construct($pattern, $httpMethod, $handler, $params = [])
    {
        $this->pattern = $pattern;
        $this->httpMethod = $httpMethod;
        if (is_callable($handler)) {
            $this->callable = $handler;
        } else if (is_array($handler)) {
            $this->handler = $handler;
        }
        $this->params = $params;    
    }

    public function compare($pattern)
    {
        $regex = '~^' . $this->pattern . '$~';
        return (bool) preg_match($regex, $pattern);
    }
}
