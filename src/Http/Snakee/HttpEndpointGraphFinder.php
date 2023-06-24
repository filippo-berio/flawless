<?php

namespace Flawless\Http\Snakee;

use Flawless\Http\Snakee\Endpoint\BaseSnakeeEndpointHandler;
use Flawless\Tools\FileFinder;
use Flawless\Snakee\GraphInterface;
use Flawless\SnakeePrinter\GraphFinderInterface;
use Flawless\SnakeePrinter\PrintedGraph;
use Psr\Container\ContainerInterface;

use function WyriHaximus\listClassesInDirectories;

class HttpEndpointGraphFinder implements GraphFinderInterface
{
    public function __construct(
        private ContainerInterface $container
    ) {
    }

    public function findGraphs(): array
    {
        $rootDir = $this->container->get('rootDir');
        $graphs = [];
        $classes = listClassesInDirectories(
            "$rootDir/src"
        );
        foreach($classes as $class) {
            if (is_subclass_of($class, BaseSnakeeEndpointHandler::class)) {
                $graphs[] = $this->getPrintedGraph($class);
            }
        }
        return $graphs;
    }

    private function getPrintedGraph(string $endpointClass): PrintedGraph
    {
        $finder = new FileFinder();
        $file = $finder->findByNamespace($endpointClass, $this->container->get('rootDir'));
        /** @var GraphInterface $endpointHandler */
        $endpointHandler = $this->container->get($endpointClass);
        return new PrintedGraph($endpointHandler->getGraph(), file_get_contents($file));
    }
}
