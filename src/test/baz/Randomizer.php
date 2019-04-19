<?php

namespace Test\Baz;

class Randomizer
{
    public function random() : int
    {
        return rand(0, 1000);
    }
}