<?php

namespace Flawless\Http\Runner;

use Flawless\Http\Request\Request;
use Flawless\Snakee\SnakeeConfiguratorInterface;

class Runner
{
    public function __construct(
        SnakeeConfiguratorInterface $snakee
    ) {
    }

    public function run()
    {
        $request = Request::fromGlobals();
        foreach ($this->snakeeRequestMiddlewares as $middleware) {
            $middleware->setRequest($request);
        }
        $this->application->withRequest($request)->execute();
        
    }
}
