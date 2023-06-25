<?php

namespace Flawless\SnakeePrinter\GraphFinder;

use Flawless\Http\Snakee\Endpoint\BaseSnakeeEndpointHandler;
use Flawless\SnakeePrinter\Data\PrintedEdge;
use Flawless\SnakeePrinter\Data\PrintedNode;
use Flawless\Snakee\GraphInterface;
use Flawless\SnakeePrinter\Data\PrintedGraph;
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
                $graphs[] = $this->getGraph($class);
            }
        }
        return $graphs;
    }

    private function getGraph(string $endpointClass): array
    {
        /** @var GraphInterface $endpointHandler */
        $endpointHandler = $this->container->get($endpointClass);
        return $endpointHandler->getGraph();
    }

    /**
     * @param array $graph
     * @return PrintedNode[]
     */
    private function getNodes(array $graph): array
    {
        $startingNodes = array_keys($graph);
        $startingNodes = array_combine($startingNodes, $startingNodes);

        foreach ($graph as $fork) {
            foreach ($fork as $node) {
                unset($startingNodes[$node]);
            }
        }

        $nodes = [];
        foreach ($startingNodes as $rootNode) {
            $nodes[] = $this->getPrintedNode($rootNode, $graph);
        }

        return $nodes;
    }

    private function getPrintedNode(string $nodeClass, array $graph): PrintedNode
    {
        $edges = [];

        foreach ($graph[$nodeClass] ?? [] as $output => $node) {
            $nextNode = $this->getPrintedNode($node, $graph);
            $edges[] = new PrintedEdge($output, $nextNode);
        }

        return new PrintedNode($nodeClass, $edges);
    }
}
