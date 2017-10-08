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

namespace SmartDump\Formatter\StringFormatter\Dom\SimpleHtml;

use DOMDocument;
use SmartDump\Formatter\StringFormatter\Dom\MarkupInterface;
use SmartDump\Node\NodeInterface;

/**
 * Class SimpleHtmlMarkup
 *
 * @package    SmartDump
 * @subpackage Formatter
 */
class SimpleHtmlMarkup implements MarkupInterface
{
    /**
     * @inheritdoc
     */
    public function appendHead(DOMDocument $domDocument)
    {
    }

    /**
     * @inheritdoc
     */
    public function container(DOMDocument $domDocument, NodeInterface $node)
    {
        $element = $domDocument->createElement('div');
        $element->setAttribute('id', 'smartdump-simplehtml');

        return $element;
    }

    /**
     * @inheritdoc
     */
    public function scalarNode(DOMDocument $domDocument, NodeInterface $node)
    {
        $element = $domDocument->createElement('div', $node->getStringValue());
        $element->setAttribute('class', 'scalar-node ' . implode(' ', $node->getTypes()));

        return $element;
    }

    /**
     * @inheritdoc
     */
    public function aggregateNode(DOMDocument $domDocument, NodeInterface $node)
    {
        $element = $domDocument->createElement('div');
        $element->setAttribute('class', 'aggregate-node ' . implode(' ', $node->getTypes()));

        $nameElement = $domDocument->createElement('span', $node->getStringValue());
        $nameElement->setAttribute('class', 'aggregate-node-name');
        $element->appendChild($nameElement);

        return $element;
    }

    /**
     * @inheritdoc
     */
    public function aggregateChildrenContainer(DOMDocument $domDocument, NodeInterface $node)
    {
        $element = $domDocument->createElement('div');
        $element->setAttribute('class', 'aggregate-children-container');

        return $element;
    }

    /**
     * @inheritdoc
     */
    public function aggregateChildNode(DOMDocument $domDocument, NodeInterface $node)
    {
        $element = $domDocument->createElement('div');
        $element->setAttribute('class', 'aggregate-child-node');

        $nameElement = $domDocument->createElement('div', $node->getName());
        $nameElement->setAttribute('class', 'aggregate-child-name');
        $element->appendChild($nameElement);

        $nameElement = $domDocument->createElement('div', '=>');
        $nameElement->setAttribute('class', 'aggregate-child-name-separator');
        $element->appendChild($nameElement);

        return $element;
    }
}
