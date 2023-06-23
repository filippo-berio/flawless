<?php

namespace Flawless\Snakee\Printer;

class SnakeePrinter
{
    /**
     * @param GraphFinderInterface[] $graphFinders
     */
    public function __construct(
        private array $graphFinders,
        private StaticPageCompiler $pageCompiler
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
