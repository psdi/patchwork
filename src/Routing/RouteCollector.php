<?php

namespace Routing;

class RouteCollector
{
    /** @var Route[] */
    private $routes = [];

    public function checkExistingRoutes($pattern)
    {
        $found = false;
        foreach ($this->routes as $route) {
            if ($route->compare($pattern)) {
                $found = true;
                ($route->callable)();
            }
        }
        if (!$found) {
            // todo: throw 404
            echo '<pre>404 Not Found';
            exit();
        }
    }

    public function addRoute(Route $route)
    {
        $this->routes[] = $route;
    }
    
}