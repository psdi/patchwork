<?php

namespace Routing;

use Http\Request;
use Routing\RouteFactory;

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

        $requestUri = $this->request->getAttribute('requestUri');
        $routeMatch = '';
        foreach ($this->routes as $route) {
            if ($route->compare($requestUri)) {
                $routeMatch = $route;
                $this->request->setAttribute('handler', $route->handler);
            }
        }

        //todo (later): handle all types of urls

        if (!$routeMatch) {
            throw new \ErrorException('No controller found - optimize this thrown error!', 404);
        } else {
            if (count($routeMatch->params) && key_exists('required', $routeMatch->params)) {
                // Retrieve param list
                $params = array_keys($routeMatch->params['required']);

                // Get request uri and route to countercheck it with
                $url = $requestUri;
                $route = $routeMatch->routeWithParams;

                // Set a limit variable
                $limit = 0;

                while ((false !== strpos($url, '/')) && $limit < 8) {
                    // Trim leftmost slashes
                    $url = ltrim($url, '/');
                    $route = ltrim($route, '/');

                    // Get one part of the route
                    $urlFragment = substr($url, 0, strpos($url, '/') ?: strlen($url));
                    $routeFragment = substr($route, 0, strpos($route, '/') ?: strlen($route));

                    // If that fragment is a recognized param
                    if (in_array(ltrim($routeFragment, ':'), $params)) {
                        $paramName = ltrim($routeFragment, ':');
                        $paramRegex = $routeMatch->params['required'][$paramName];

                        // Final regex check before setting the parameter
                        if (preg_match('~^' . $paramRegex . '$~', $urlFragment)) {
                            $this->request->setParam(
                                $paramName,
                                $urlFragment
                            );
                        }
                    }

                    // Remove part from respective strings
                    $url = substr($url, strlen($urlFragment));
                    $route = substr($route, strlen($routeFragment));
                    $limit++;
                }
            }
        }
    }

    public function addRoute($routeWithParams, $httpMethod, $handler, $params = [])
    {
        foreach ($this->routes as $route) {
            if ($route->routeWithParams === $routeWithParams) {
                throw new \InvalidArgumentException('Route with path ' . $routeWithParams . ' already exists.');
            }
        }
        $this->routes[] = RouteFactory::create($routeWithParams, $httpMethod, $handler, $params);
    }

    public function get($pattern, $handler, $params = [])
    {
        $this->addRoute($pattern, 'GET', $handler, $params);
    }

    public function post($pattern, $handler, $params = [])
    {
        $this->addRoute($pattern, 'POST', $handler, $params);
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
