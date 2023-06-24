<?php

namespace Flawless\SnakeePrinter;

use JsonSerializable;

readonly class PrintedGraph
{
    public function __construct(
        public array $graph,
        public string $sourceCode,
    ) {
    }

    public function toArray(): array
    {
        return [
            'graph' => $this->graph,
            'sourceCode' => $this->sourceCode,
        ];
    }
}
