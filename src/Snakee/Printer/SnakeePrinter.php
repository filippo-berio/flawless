<?php

namespace Flawless\Snakee\Printer;

class SnakeePrinter
{
    /**
     * @param GraphFinderInterface[] $graphFinders
     */
    public function __construct(
        private array $graphFinders,
    ) {
    }

    public function print()
    {
        dd($this->graphFinders, 'print');
    }
}
