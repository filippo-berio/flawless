<?php

namespace Flawless\SnakeePrinter;

use Flawless\Tools\FileCreator;

class ApplicationCompiler
{
    public function __construct(
        private string $rootDir,
        private FileCreator $fileCreator,
    ) {
    }

    /**
     * @param PrintedGraph[] $graphs
     * @return string
     */
    public function compile(array $graphs): string
    {
        $graphs = array_map(
            fn(PrintedGraph $graph) => $graph->toArray(),
            $graphs
        );

        $dir = "$this->rootDir/public/snakee";

        ob_start();
        extract([$graphs]);
        require(__DIR__ . '/stimulus/index-template.php');
        $indexHtml = ob_get_contents();
        ob_end_clean();

        $this->fileCreator->createFile("$dir/index.html", $indexHtml);

        copy(__DIR__ . '/stimulus/application.ts', "$dir/application.ts");

        return $dir;
    }
}
