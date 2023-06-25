<?php

namespace Flawless\SnakeePrinter;

use Flawless\SnakeePrinter\GraphFinder\GraphFinderInterface;

class SnakeePrinter
{
    /**
     * @param GraphFinderInterface[] $graphFinders
     */
    public function __construct(
        private array $graphFinders,
        private ApplicationCompiler $pageCompiler
    ) {
    }

    public function print(): string
    {
        $graphs = [];
        foreach ($this->graphFinders as $finder) {
            $graphs = [
                ...$graphs,
                ...$finder->findGraphs(),
            ];
        }

        return $this->pageCompiler->compile($graphs);
    }
}
