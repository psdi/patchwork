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
            $controllerClass = $this->request->getController();
            $action = $this->request->getAction(); // todo: optimize this cheat
            $controller = new $controllerClass();
            $params = $this->request->getAllParams();
            call_user_func_array(
                [
                    $controller,
                    $action
                ],
                $params
            );
            // todo: run with parameters
        }
    }    
}