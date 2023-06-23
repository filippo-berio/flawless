<?php

namespace Flawless\Tools;

class FileFinder
{
    public function findByNamespace(string $namespace, string $projectRoot): string
    {
        $parts = explode('\\', $namespace);
        $prefix = array_shift($parts) . '\\';

        $composerJsonParser = new ComposerJsonParser("$projectRoot/composer.json");

        foreach ($composerJsonParser->getAutoloadPaths() as $namespacePrefix => $srcPath) {
            if ($namespacePrefix === $prefix) {
                $projectRoot .= "/$srcPath";
            }
        }

        return $projectRoot . implode('/', $parts) . '.php';
    }
}
