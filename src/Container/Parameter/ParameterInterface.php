<?php

namespace Flawless\Container\Parameter;

use Psr\Container\ContainerInterface;

interface ParameterInterface
{
    public function resolve(ContainerInterface $container);
}
