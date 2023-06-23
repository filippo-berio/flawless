<?php

namespace Flawless\Tools;

class FileCreator
{
    public function __construct()
    {
    }

    public function createFile(string $path, $content): void
    {
        $parts = explode('/', $path);
        $file = array_pop($parts);
        $dir = '';
        foreach ($parts as $part) {
            if (!is_dir($dir .= "/$part")) {
                mkdir($dir);
            }
        }
        file_put_contents("$dir/$file", $content);
    }
}
