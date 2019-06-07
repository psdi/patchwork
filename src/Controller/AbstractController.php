<?php

namespace Patchwork\Controller;

use Http\Request;

abstract class AbstractController
{
    /** @var Request */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

}
