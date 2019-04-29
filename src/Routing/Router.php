<?php

namespace Routing;

use Http\Request;

class Router
{
    /** @var Request $request */
    private $request;
    /** @var Route[] $routes */
    private $routes;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->processRequest();
    }

    /**
     * Breaks down a request (uri) into blocks
     */
    public function processRequest()
    {
        if (!$this->request) {
            throw new \ErrorException('No request object found.');
        }
        $uriComponents = parse_url($this->request->getRequestUri());
        // todo
    }

    public function addRoute($pattern, $httpMethod, $callable, $params = [])
    {
        $this->routes[] = $this->createRoute($pattern, $httpMethod, $callable, $params);
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

    public function getRequest()
    {
        return $this->request ?? null;
    }

    public function getRoutes()
    {
        return $this->routes ?? [];
    }

}
