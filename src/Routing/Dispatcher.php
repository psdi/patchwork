<?php

use Http\Request;

namespace Routing;

class Dispatcher
{
    /** @var Router $router */
    public $router;
    /** @var Request $request */
    public $request;

    public function __construct(Router $router)
    {
        $this->router = $router;
        $this->request = $router->getRequest();
    }

    public function dispatch()
    {
        $handler = $this->request->getAttribute('handler');

        if (!is_array($handler)) {
            $handler = [$handler];
        }

        foreach ($handler as $h) {
            if (is_string($h)) {
                $this->runObjectMethod($h);
            }
            //todo: run callbacks/closures
        }
    }

    /**
     * Run an object method
     *
     * @param $pair - e.g. 'class::method'
     */
    public function runObjectMethod($pair)
    {
        list($controllerClass, $action) = explode('::', $pair);
        $controller = new $controllerClass($this->request);
        call_user_func([$controller, $action]);
    }

    /**
     * Return a requested parameter
     * 
     * @var string $name The parameter name
     * @return mixed|null
     */
    public function getParam(string $name)
    {
        if ($this->request->getParam($name)) {
            return $this->request->getParam($name);
        }
        return null;
    }
}
