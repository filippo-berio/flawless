<?php

namespace Flawless\SnakeePrinter;

use Flawless\SnakeePrinter\Data\PrintedGraph;
use Flawless\Tools\FileCreator;

class ApplicationCompiler
{
    private const COPY_FILES = [
        '/stimulus/application.ts',
    ];

    public function __construct(
        private string $rootDir,
        private FileCreator $fileCreator,
    ) {
    }

    public function compile(array $graphs): string
    {
        $dir = "$this->rootDir/public/snakee";

        ob_start();
        $graphs = array_map(
            fn(array $graph) => str_replace('\\\\', '', json_encode($graph)),
//            fn(array $graph) => json_encode($graph),
            $graphs
        );
        require(__DIR__ . '/stimulus/index-template.php');
        $indexHtml = ob_get_contents();
        ob_end_clean();

        $this->fileCreator->createFile("$dir/index.html", $indexHtml);

        foreach (self::COPY_FILES as $file) {
            $parts = explode('/', $file);
            $fileName = array_pop($parts);
            copy(__DIR__ . $file, "$dir/$fileName");
        }

        return $dir;
    }
}
