<?php

namespace Flawless\SnakeePrinter\Data;

class PrintedNode
{
    /**
     * @param string $title
     * @param PrintedEdge[] $edges
     * @param string $sourceCode
     */
    public function __construct(
        public string $title,
        public array  $edges,
        public string $sourceCode = '',
    ) {
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSourceCode(): string
    {
        return $this->sourceCode;
    }
}
