<?php

namespace Flawless\Console;

class Input
{
    private array $arguments = [];
    private array $options = [];

    public function __construct(array $argv)
    {
        foreach ($argv as $arg) {
            $this->handleArg($arg);
        }
    }

    public function getArguments(): array
    {
        return $this->arguments;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function getOption(string $option)
    {
        return $this->options[$option] ?? null;
    }

    private function handleArg(string $argument): void
    {
        if ($argument[0] !== '-') {
            $this->arguments[] = $argument;
            return;
        }

        $parts = explode('=', $argument);
        $option = $this->sliceOptionKey($parts[0]);

        if (count($parts) === 1) {
            $this->options[$option] = true;
            return;
        }

        $value = $parts[1];
        $this->options[$option] = $value;
    }

    private function sliceOptionKey(string $key): string
    {
        return str_replace('-', '', $key);
    }
}
