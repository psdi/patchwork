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
    }

    /**
     * Breaks down a request (uri) into blocks
     */
    public function processRequest()
    {
        if (!$this->request) {
            throw new \ErrorException('No request object found.');
        }

        $requestUri = $this->request->getRequestUri();
        $handler = [];
        foreach ($this->routes as $route) {
            if ($route->compare($requestUri)) {
                $handler = $route->handler ? $route->handler : $route->callable;
            }
        }

        // note: is_array is tested first because arrays with callable
        // class/method combinations are somehow considered callables
        if (is_array($handler)) {
            $this->request->setHandler($handler);
        } else if (is_callable($handler)) {
            $this->request->setCallable($handler);
        } else {
            // todo: throw new exception
        }
    }

    public function createRegexPattern($pattern, $params)
    {
        if (!$pattern) {
            // todo: throw an error
        }

        if (isset($params['required'])) {
            foreach ($params['required'] as $name => $format) {
                $signedName = ':' . $name;

                if (false !== strpos($pattern, $signedName, 0)) {
                    $pattern = str_replace($signedName, $format, $pattern);
                }
            }
        }

        return $pattern;

        // notes: in processRequest, idk check against patterns and stuff
    }

    public function addRoute($pattern, $httpMethod, $handler, $params = [])
    {
        $pattern = $this->createRegexPattern($pattern, $params);
        if (count($handler) !== 2) {
            // todo: throw exception or something
        }
        // todo: check if route already exists
        $this->routes[] = $this->createRoute($pattern, $httpMethod, $handler, $params);
    }

    public function get($pattern, $handler, $params = [])
    {
        $this->addRoute($pattern, 'GET', $handler, $params);
    }

    public function post($pattern, $handler, $params = [])
    {
        $this->addRoute($pattern, 'POST', $handler, $params);
    }

    public function createRoute($pattern, $httpMethod, $handler, $params = [])
    {
        return new Route($pattern, $httpMethod, $handler, $params);
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
