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
        if ($this->request->getCallable() !== null) {
            // todo: run with parameters
        } else if ($this->request->getController() && $this->request->getAction()) {
            $controller = $this->request->getController();
            $action = $this->request->getAction(); // todo: optimize this cheat
            $test = new $controller();
            $test->$action();
            // todo: run with parameters
        }
    }    
}