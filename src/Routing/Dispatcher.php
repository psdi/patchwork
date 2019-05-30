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
            $action = $this->request->getAction();
            $controller = new $controllerClass($this);
            $params = $this->request->getAllParams();
            call_user_func_array(
                [
                    $controller,
                    $action
                ],
                $params
            );
        }
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
