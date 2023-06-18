<?php

namespace Flawless\Kernel\Tool;

class FileFinder
{
    public function findByNamespace(string $namespace, string $projectRoot): string
    {
        $composerData = file_get_contents("$projectRoot/composer.json");
        $composerData = json_decode($composerData, true);

        $parts = explode('\\', $namespace);
        $prefix = array_shift($parts) . '\\';

        foreach ($composerData['autoload']['psr-4'] as $namespacePrefix => $srcPath) {
            if ($namespacePrefix === $prefix) {
                $projectRoot .= "/$srcPath";
            }
        }

        return $projectRoot . implode('/', $parts) . '.php';
    }
}
