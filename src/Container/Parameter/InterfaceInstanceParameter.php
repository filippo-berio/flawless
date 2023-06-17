<?php

namespace Flawless\Container\Parameter;

use Flawless\Http\Snakee\GraphFinder;

class InterfaceInstanceParameter implements ParameterInterface
{
    public function __construct(
        private string $interface,
    ) {
    }

    public function resolve()
    {
        $children = [];
        foreach(get_declared_classes() as $class) {

            dd(get_declared_classes());
            dd(class_implements(GraphFinder::class));
            if (in_array($this->interface, class_implements($class))) {
                dd($class);
                $children[] = $class;
            }
        }
        dd($children);
    }
}
