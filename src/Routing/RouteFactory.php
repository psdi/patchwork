<?php

namespace Routing;

use Routing\Route;

class RouteFactory
{
    public static function create($pattern, $httpMethod, $handler, $params): Route
    {
        $route = new Route();

        $route->routeWithParams = $pattern;
        $route->httpMethod = $httpMethod;
        $route->params = $params;
        $route->regexPattern = self::buildRegexPattern($pattern, $params);
        $handler = self::validateHandler($handler);
        if (!$handler) {
            throw new \ErrorException('Given handler ' . $handler . ' is not valid or recognized.');
        }
        $route->handler = $handler;      

        return $route;
    }

    public static function buildRegexPattern(string $pattern, array $params): string
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

        // todo: consider optional parameters

        return $pattern;
    }

    public static function validateHandler($handler)
    {
        // if array, perform a recursive call
        if (is_array($handler)) {
            $queue = [];
            foreach ($handler as $h) {
                $item = self::validateHandler($h);
                if ($item) {
                    $queue[] = $item;
                }
            }

            if (count($handler) === count($queue)) {
                return $handler;
            }

        } else {

            // if given handler has 'class::method' structure
            if (is_string($handler) && is_callable($handler)) {
                $parts = explode('::', $handler);
                if (count($parts) !== 2) {
                    return;
                }
                if (method_exists($parts[0], $parts[1])) {
                    return $handler;
                }
            }

            // anonymous functions or closures (not sure of the difference)
            if ($handler instanceof \Closure) {
                return $handler;
            }

        }

        return;
    }
}