<?php

namespace Routing;

class Route
{
    public $uri = '';
    public $httpMethod = '';
    public $callable = '';
    public $params = [];

    public function __construct($uri, $httpMethod, $callable, $params = [])
    {
        $this->uri = $uri;
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