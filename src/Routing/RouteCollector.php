<?

namespace Routing;

class RouteCollector
{
    /** @var Route[] */
    private $routes = [];

    public function checkExistingRoutes($pattern)
    {
        foreach ($this->routes as $route) {
            if ($route->compare($pattern)) {
                ($route->callable)();
            }
        }
    }

    public function addRoute(Route $route)
    {

    }
}