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

    public function print()
    {
        $graphs = [];
        foreach ($this->graphFinders as $finder) {
            $graphs = [
                ...$graphs,
                ...$finder->findGraphs(),
            ];
        }

        $filePath = $this->pageCompiler->compile($graphs);

        dump($filePath);
    }

    private function compileDiagram(array $graphs)
    {

    }
}
