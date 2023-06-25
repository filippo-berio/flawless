import { Application, Controller } from 'stimulus';
import RevealController from 'stimulus-reveal';
import ForceGraph from 'force-graph';

type GraphType = {};

export class GraphController extends Controller {
    static values = {
        graph: Object,
    };

    static targets = ['container'];

    connect() {
        const nodes = [];
        const links = [];
        Object.keys(this.graphValue).forEach(node => {
            if (nodes.indexOf(node) === -1) {
                nodes.push(node);
            }
            const fork = this.graphValue[node] || {};
            Object.keys(fork).forEach(output => {
                const targetNode = fork[output];
                if (nodes.indexOf(targetNode) === -1) {
                    nodes.push(targetNode);
                }
                links.push({
                    source: node,
                    target: targetNode,
                    value: 'Link ' + 'output'
                })
            })
        })
        ForceGraph()(this.containerTarget)
            .graphData({
                "nodes": nodes.map(node => {
                    return {
                        id: node
                    }
                }),
                "links": links
            })
            .nodeId('id')
            .nodeLabel('id')
            .nodeAutoColorBy('group')
            .nodeCanvasObject((node, ctx, globalScale) => {
                const label = node.id;
                const fontSize = 12/globalScale;
                ctx.font = `${fontSize}px Sans-Serif`;
                const textWidth = ctx.measureText(label).width;
                const bckgDimensions = [textWidth, fontSize].map(n => n + fontSize * 0.2); // some padding

                ctx.fillStyle = 'rgba(255, 255, 255, 0.8)';
                ctx.fillRect(node.x - bckgDimensions[0] / 2, node.y - bckgDimensions[1] / 2, ...bckgDimensions);

                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                ctx.fillStyle = node.color;
                ctx.fillText(label, node.x, node.y);

                node.__bckgDimensions = bckgDimensions; // to re-use in nodePointerAreaPaint
            })
            .nodePointerAreaPaint((node, color, ctx) => {
                ctx.fillStyle = color;
                const bckgDimensions = node.__bckgDimensions;
                bckgDimensions && ctx.fillRect(node.x - bckgDimensions[0] / 2, node.y - bckgDimensions[1] / 2, ...bckgDimensions);
            });
    }
}

window.Stimulus = Application.start()
Stimulus.register('reveal', RevealController);
Stimulus.register('graph', GraphController);
