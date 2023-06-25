<?php

namespace Flawless\SnakeePrinter\Data;

use JsonSerializable;

class PrintedGraph
{
    /**
     * @param PrintedNode[] $rootNodes
     */
    public function __construct(
        private array $rootNodes,
    ) {
    }

    public function getRootNodes(): array
    {
        return $this->rootNodes;
    }

    public function getSourceCode(): string
    {
        return $this->sourceCode;
    }

    public function toArray(): array
    {
        return [
            'graph' => $this->graph,
            'sourceCode' => $this->sourceCode,
        ];
    }
}
