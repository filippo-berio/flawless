<?php

namespace Flawless\SnakeePrinter\Data;

class PrintedEdge
{
    public function __construct(
        public string $output,
        public PrintedNode $node,
    ) {
    }

}
