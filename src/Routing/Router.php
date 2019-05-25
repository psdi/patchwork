<?php

namespace Routing;

use Http\Request;

class Router
{
    /** @var Request $request */
    private $request;
    /** @var Route[] $routes */
    private $routes = [];

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
        $routeMatch = '';
        foreach ($this->routes as $route) {
            if ($route->compare($requestUri)) {
                $routeMatch = $route;
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

        //todo (later): handle all types of urls

        if ($routeMatch) {
            if (count($routeMatch->params) && key_exists('required', $routeMatch->params)) {
                $params = array_keys($routeMatch->params['required']);
                $url = $this->request->getRequestUri();
                $route = $routeMatch->routeWithParams;
                $limit = 0;

                do {
                    $url = ltrim($url, '/');
                    $route = ltrim($route, '/');
                    $urlFragment = substr($url, 0, strpos($url, '/') ?: strlen($url));   //don't you have a better var name
                    $routeFragment = substr($route, 0, strpos($route, '/') ?: strlen($route));

                    if (in_array(ltrim($routeFragment, ':'), $params)) {
                        $paramName = ltrim($routeFragment, ':');
                        $paramRegex = $routeMatch->params['required'][$paramName];
                        if (preg_match('~^' . $paramRegex . '$~', $urlFragment)) {
                            $this->request->setParam(
                                $paramName,
                                $urlFragment
                            );
                        }
                    }

                    $url = substr($url, strlen($urlFragment));
                    $route = substr($route, strlen($routeFragment));
                    $limit++;
                } while ((false !== strpos($url, '/')) && $limit < 8);
                // while or do while?
            }
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
    }

    public function addRoute($routeWithParams, $httpMethod, $handler, $params = [])
    {
        $regexPattern = $this->createRegexPattern($routeWithParams, $params);
        if (count($handler) !== 2) {
            // todo: throw exception
        }
        // todo: check if route already exists
        $this->routes[] = $this->createRoute($regexPattern, $httpMethod, $handler, $params, $routeWithParams);
    }

    public function get($pattern, $handler, $params = [])
    {
        $this->addRoute($pattern, 'GET', $handler, $params);
    }

    public function post($pattern, $handler, $params = [])
    {
        $this->addRoute($pattern, 'POST', $handler, $params);
    }

    public function createRoute($regexPattern, $httpMethod, $handler, $params = [], $routeWithParams)
    {
        return new Route($regexPattern, $httpMethod, $handler, $params, $routeWithParams);
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
