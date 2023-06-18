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
        $graphs = [];
        foreach ($this->graphFinders as $finder) {
            $graphs = [
                ...$graphs,
                ...$finder->findGraphs(),
            ];
        }
        dump($graphs);
    }
}
