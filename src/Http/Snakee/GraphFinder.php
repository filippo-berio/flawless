<?php

namespace Flawless\Http\Snakee;

use Flawless\Snakee\Printer\GraphFinderInterface;

class GraphFinder implements GraphFinderInterface
{

    public function findGraphs(): array
    {
        dd('find http graph');
    }
}
