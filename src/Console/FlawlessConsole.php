<?php

namespace Flawless\Console;

use Flawless\Container\Container;
use Flawless\Kernel\Application;
use Flawless\Kernel\ApplicationInterface;
use Flawless\Kernel\FlawlessFacade;
use Psr\Container\ContainerInterface as PsrContainerInterface;

class FlawlessConsole extends FlawlessFacade
{
    /** @var Application */
    protected ApplicationInterface $application;

    private Input $input;

    public function __construct(
        ApplicationInterface $application
    ) {
        parent::__construct($application);
    }

    public static function boot(array $argv, string $rootDir = null): self
    {
        $container = new Container();
        $application = $container->get(Application::class);

        if ($rootDir) {
            $container->register('rootDir', $rootDir);
        }
        
        $self = new self($application);
        $self->container = $container;

        // first arg is binary path
        array_shift($argv);
        $self->input = new Input($argv);

        return $self;
    }

    public function getContainer(): PsrContainerInterface
    {
        return $this->container;
    }
}
