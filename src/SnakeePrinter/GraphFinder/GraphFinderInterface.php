<?php

namespace Flawless\SnakeePrinter\GraphFinder;

use Flawless\SnakeePrinter\Data\PrintedGraph;

interface GraphFinderInterface
{
    /**
     * @return PrintedGraph[]
     */
    public function findGraphs(): array;
}
