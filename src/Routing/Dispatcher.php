<?php

namespace Routing;

class Dispatcher
{
    /** @var RouteCollector */
    public $routeCollector;

    /**
     * Accepts a request and returns 
     */
    public function processRequest($request)
    {
        // https://stackoverflow.com/questions/20323382/representation-part-in-a-rmr-architecture
        // https://github.com/bramus/router
        // https://codereview.stackexchange.com/questions/175419/php-routing-with-mvc-structure
        //  - in übergebene Funktion schauen - interessant?
        // auch interessant: https://stackoverflow.com/questions/12430181/how-does-mvc-routing-work
        // save this somewhere: https://restful-api-design.readthedocs.io/en/latest/resources.html
    }

    public function addRoute($httpMethod, $uri, $closure, $params)
    {
        
    }

}