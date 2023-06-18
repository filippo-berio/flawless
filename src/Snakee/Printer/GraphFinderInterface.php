<?php

namespace Flawless\Snakee\Printer;

interface GraphFinderInterface
{
    /**
     * @return PrintedGraph[]
     */
    public function findGraphs(): array;
}
