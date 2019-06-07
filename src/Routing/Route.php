<?php

namespace Routing;

class Route
{
    /** @var string */
    public $regexPattern = '';
    /** @var string */
    public $httpMethod = '';
    /** @var callable|callable[]|\Closure */
    public $handler = [];
    /** @var mixed[] */
    public $params = [];
    /** @var string */
    public $pattern = '';

    public function compare($pattern)
    {
        $regexPattern = '~^' . $this->regexPattern . '$~';
        return (bool) preg_match($regexPattern, $pattern);
    }
}
