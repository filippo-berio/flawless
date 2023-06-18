<?php

namespace Flawless\Container\Parameter;

use Psr\Container\ContainerInterface;

use function WyriHaximus\listClassesInDirectories;

class InterfaceInstanceParameter implements ParameterInterface
{
    public function __construct(
        private string $interface,
    ) {
    }

    public function resolve(ContainerInterface $container)
    {
        $rootDir = $container->get('rootDir');
        $children = [];
        $classes = listClassesInDirectories(
            "$rootDir/vendor/filippo-berio",
            "$rootDir/src"
        );
        foreach($classes as $class) {
            if (in_array($this->interface, class_implements($class))) {
                $children[] = $container->get($class);
            }
        }
        
        return $children;
    }
}
