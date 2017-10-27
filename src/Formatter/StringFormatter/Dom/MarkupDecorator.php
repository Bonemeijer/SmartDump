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

namespace SmartDump\Formatter\StringFormatter\Dom;

use DOMDocument;
use SmartDump\Node\NodeInterface;

/**
 * Class MarkupDecorator
 *
 * @package    SmartDump
 * @subpackage Formatter
 */
abstract class MarkupDecorator implements MarkupInterface
{
    /**
     * Get markup document
     *
     * @return MarkupInterface
     */
    abstract public function getMarkupDocument();

    /**
     * @inheritdoc
     */
    public function appendHead(DOMDocument $domDocument)
    {
        $this->getMarkupDocument()->appendHead($domDocument);
    }

    /**
     * @inheritdoc
     */
    public function container(DOMDocument $domDocument, NodeInterface $node)
    {
        return $this->getMarkupDocument()->container($domDocument, $node);
    }

    /**
     * @inheritdoc
     */
    public function scalarNode(DOMDocument $domDocument, NodeInterface $node)
    {
        return $this->getMarkupDocument()->scalarNode($domDocument, $node);
    }

    /**
     * @inheritdoc
     */
    public function aggregateNode(DOMDocument $domDocument, NodeInterface $node)
    {
        return $this->getMarkupDocument()->aggregateNode($domDocument, $node);
    }

    /**
     * @inheritdoc
     */
    public function aggregateChildrenContainer(DOMDocument $domDocument, NodeInterface $node)
    {
        return $this->getMarkupDocument()->aggregateChildrenContainer($domDocument, $node);
    }

    /**
     * @inheritdoc
     */
    public function aggregateChildNode(DOMDocument $domDocument, NodeInterface $node)
    {
        return $this->getMarkupDocument()->aggregateChildNode($domDocument, $node);
    }

    /**
     * @inheritdoc
     */
    public function appendFoot(DOMDocument $domDocument)
    {
        $this->getMarkupDocument()->appendFoot($domDocument);
    }
}
