<?php

namespace Flawless\SnakeePrinter;

interface GraphFinderInterface
{
    /**
     * @return PrintedGraph[]
     */
    public function findGraphs(): array;
}
