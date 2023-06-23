<?php

namespace Flawless\Tools;

class ComposerJsonParser
{
    public function __construct(private string $path)
    {
    }

    public function getAutoloadPaths(): array
    {
        $composerData = file_get_contents($this->path);
        $composerData = json_decode($composerData, true);
        return $composerData['autoload']['psr-4'];
    }
}
