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
        $element = $domDocument->createElement('div');
        $element->setAttribute('class', 'scalar-node ' . implode(' ', $node->getTypes()));
        $element->appendChild($domDocument->createTextNode($node->getStringValue()));

        return $element;
    }

    /**
     * @inheritdoc
     */
    public function aggregateNode(DOMDocument $domDocument, NodeInterface $node)
    {
        $element = $domDocument->createElement('div');
        $element->setAttribute('class', 'aggregate-node ' . implode(' ', $node->getTypes()));

        $nameElement = $domDocument->createElement('span');
        $nameElement->setAttribute('class', 'aggregate-node-name');
        $nameElement->appendChild($domDocument->createTextNode($node->getStringValue()));
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
        $nodeContainer = $domDocument->createElement('div');
        $nodeContainer->setAttribute('class', 'aggregate-child-node');

        $nameContainer = $domDocument->createElement('div');
        $nameContainer->setAttribute('class', 'aggregate-child-name');
        $nodeContainer->appendChild($nameContainer);

        $nameElement = $domDocument->createElement('span');
        $nameElement->setAttribute('class', 'name');
        $nameElement->appendChild($domDocument->createTextNode($node->getName()));
        $nameContainer->appendChild($nameElement);

        $visibility = $node->getVisibility();

        if (null !== $visibility) {
            $visibilityElement = $domDocument->createElement('span');
            $visibilityElement->setAttribute('class', 'visibility');
            $visibilityElement->appendChild($domDocument->createTextNode($visibility));
            $nameContainer->appendChild($visibilityElement);
        }

        if ($node->isStatic()) {
            $visibilityElement = $domDocument->createElement('span', 'static');
            $visibilityElement->setAttribute('class', 'static');
            $nameContainer->appendChild($visibilityElement);
        }

        $separatorElement = $domDocument->createElement('div', '=>');
        $separatorElement->setAttribute('class', 'aggregate-child-name-separator');
        $nodeContainer->appendChild($separatorElement);

        return $nodeContainer;
    }

    /**
     * @inheritdoc
     */
    public function appendFoot(DOMDocument $domDocument)
    {
    }
}
