<?php

namespace Flawless\Snakee\Printer;

readonly class PrintedGraph
{
    public function __construct(
        public array $graph,
        public string $sourceCode,
    ) {
    }
}
