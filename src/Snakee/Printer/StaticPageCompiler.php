<?php

namespace Flawless\Snakee\Printer;

class StaticPageCompiler
{
    public function __construct(
        private string $rootDir,
    ) {
    }

    /**
     * @param PrintedGraph[] $graphs
     * @return string
     */
    public function compile(array $graphs): string
    {
        return 'static/file/path';
    }
}
