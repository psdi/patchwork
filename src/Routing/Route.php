<?php

namespace Routing;

class Route
{
    public $patterns = '';
    public $httpMethod = '';
    public $callable = '';
    public $params = [];

    public function __construct($patterns, $httpMethod, $callable, $params = [])
    {
        $this->patterns = $patterns;
        $this->httpMethod = $httpMethod;
        $this->callable = $callable;
        $this->params = $params;    
    }

    public function compare($pattern)
    {
        // compare using regex if request URI pattern
        // matches with Route->uri
    }

}