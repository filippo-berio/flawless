<?php

namespace Flawless\Snakee\Printer;

use Flawless\Tools\FileCreator;
use SebastianBergmann\Template\Template;

class StaticPageCompiler
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
        $template = new Template(__DIR__ . '/Output/output.html');
        $template->setVar([
            'count' => count($graphs)
        ]);
        $content = $template->render();
        $path = "$this->rootDir/public/snakee.html";
        $this->fileCreator->createFile($path, $content);
        return $path;
    }
}
