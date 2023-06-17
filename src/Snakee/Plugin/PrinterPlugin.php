<?php

namespace Flawless\Snakee\Plugin;

use Flawless\Container\ContainerInterface;
use Flawless\Container\Parameter\InterfaceInstanceParameter;
use Flawless\Kernel\Plugin\PluginInterface;
use Flawless\Snakee\Printer\GraphFinderInterface;

class PrinterPlugin implements PluginInterface
{

    public function bootstrap(ContainerInterface $container)
    {
        $container->register('graphFinders', new InterfaceInstanceParameter(GraphFinderInterface::class));
    }
}
