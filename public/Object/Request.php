<?php

namespace Library\Object;

use Library\Interfaces\RequestInterface;

class Request implements RequestInterface
{
    private $serverParams = [];

    public function __construct()
    {
        $this->bootstrapSelf();
    }

    private function bootstrapSelf()
    {
        foreach ($_SERVER as $key => $value) {
            $this->serverParams[$this->toCamelCase($key)] = $value;
        }
    }

    public function toCamelCase($string)
    {
        $result = strtolower($string);
        preg_match_all('/_[a-z]/', $result, $matches);
        foreach ($matches[0] as $match) {
            $c = str_replace('_', '', strtoupper($match));
            $result = str_replace($match, $c, $result);
        }
        return $result;
    }

    public function getBody()
    {
        $requestMethod = $this->serverParams['requestMethod'];

        if ($requestMethod === "GET") {
            return;
        }

        if ($requestMethod === "POST") {
            $body = [];
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
            return $body;
        }
    }

    public function getServerParams()
    {
        return $this->serverParams;
    }
}