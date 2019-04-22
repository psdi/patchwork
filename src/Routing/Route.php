<?php

namespace Routing;

class Route
{
    public $pattern = '';
    public $httpMethod = '';
    public $callable = '';
    public $params = [];

    public function __construct($pattern, $httpMethod, $callable, $params = [])
    {
        $this->pattern = $pattern;
        $this->httpMethod = $httpMethod;
        $this->callable = $callable;
        $this->params = $params;    
    }

    public function compare($pattern)
    {
        $regex = '~^' . $this->pattern . '$~';
        return (bool) preg_match($regex, $pattern);
        // compare using regex if request URI pattern
        // matches with Route->uri
    }

}