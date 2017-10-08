<?php
/**
 * MIT License
 *
 * Copyright (c) 2008-2017 SMARTDUMP
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace SmartDump\Formatter\StringFormatter;

use DOMDocument;
use DOMElement;
use SmartDump\Formatter\StringFormatter\Dom\MarkupInterface;
use SmartDump\Node\NodeInterface;

/**
 * Class DomStringFormatter
 *
 * @package    SmartDump
 * @subpackage Formatter
 */
class DomStringFormatter implements StringFormatterInterface
{
    /** @var MarkupInterface */
    protected $markupDocument;

    /**
     * Constructor
     *
     * @param MarkupInterface $markupDocument
     */
    public function __construct(
        MarkupInterface $markupDocument
    ) {
        $this->markupDocument = $markupDocument;
    }

    /**
     * @inheritdoc
     */
    public function format(NodeInterface $node)
    {
        $domDocument               = new DOMDocument('1.0', 'UTF-8');
        $domDocument->formatOutput = true;

        $this->markupDocument->appendHead($domDocument);

        $container   = $this->markupDocument->container($domDocument, $node);
        $nodeElement = $this->renderNodeElement($domDocument, $node);
        $container->appendChild($nodeElement);

        $domDocument->appendChild($container);

        return $domDocument->saveHTML();
    }

    /**
     * Render a node to DOMElement
     *
     * @param DOMDocument   $domDocument
     * @param NodeInterface $node
     * @return DOMElement
     */
    protected function renderNodeElement(DOMDocument $domDocument, NodeInterface $node)
    {
        if ($node->isAggregate()) {
            return $this->renderAggregateNode($domDocument, $node);
        }

        return $this->markupDocument->scalarNode($domDocument, $node);
    }

    /**
     * Render an aggregate node to DOMElement
     *
     * @param DOMDocument   $domDocument
     * @param NodeInterface $node
     * @return DOMElement
     */
    protected function renderAggregateNode(DOMDocument $domDocument, NodeInterface $node)
    {
        $nodeElement      = $this->markupDocument->aggregateNode($domDocument, $node);
        $aggregateElement = $this->markupDocument->aggregateChildrenContainer($domDocument, $node);

        foreach ($node->getChildren() as $childNode) {
            $childContainerElement = $this->markupDocument->aggregateChildNode($domDocument, $childNode);

            $childValueElement = $this->renderNodeElement($domDocument, $childNode);
            $childContainerElement->appendChild($childValueElement);

            $aggregateElement->appendChild($childContainerElement);
        }

        $nodeElement->appendChild($aggregateElement);

        return $nodeElement;
    }
}
