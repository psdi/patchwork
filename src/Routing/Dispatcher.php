<?php

namespace Routing;

class Dispatcher
{
    /** @var RouteCollector */
    private $routeCollector;
    /** @var array */
    private $get;
    /** @var array */
    private $post;
    /** @var string */
    private $httpMethod;
    /** @var string */
    private $requestUri;

    public function __construct(RouteCollector $collector)
    {
        $this->routeCollector = $collector;
    }

    /**
     * Accepts a request and returns 
     */
    public function processRequest($httpMethod, $requestUri, $get = [], $post = [])
    {
        $this->httpMethod = $httpMethod;
        $this->requestUri = $requestUri;
        $this->get = $get;
        $this->post = $post;
    }

    public function addRoute($pattern, $httpMethod, $callable, $params = [])
    {
        $this->routeCollector->addRoute($this->createRoute($pattern, $httpMethod, $callable, $params));
    }

    public function get($pattern, $callable, $params = [])
    {
        $this->addRoute($pattern, 'GET', $callable, $params);
    }

    public function post($pattern, $callable, $params = [])
    {
        $this->addRoute($pattern, 'POST', $callable, $params);
    }

    public function createRoute($pattern, $httpMethod, $callable, $params = [])
    {
        return new Route($pattern, $httpMethod, $callable, $params);
    }

    public function run()
    {
        if ($this->routeCollector) {
            $this->routeCollector->checkExistingRoutes($this->requestUri);
        }
    }

}