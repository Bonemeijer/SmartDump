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
 * Class MarkupDecoratorBase
 *
 * @package    SmartDump
 * @subpackage Formatter
 */
abstract class MarkupDecoratorBase implements MarkupInterface
{
    /** @var MarkupInterface */
    protected $markupDocument;

    /**
     * @inheritdoc
     */
    public function appendHead(DOMDocument $domDocument)
    {
        $this->markupDocument->appendHead($domDocument);
    }

    /**
     * @inheritdoc
     */
    public function container(DOMDocument $domDocument, NodeInterface $node)
    {
        return $this->markupDocument->container($domDocument, $node);
    }

    /**
     * @inheritdoc
     */
    public function scalarNode(DOMDocument $domDocument, NodeInterface $node)
    {
        return $this->markupDocument->scalarNode($domDocument, $node);
    }

    /**
     * @inheritdoc
     */
    public function aggregateNode(DOMDocument $domDocument, NodeInterface $node)
    {
        return $this->markupDocument->aggregateNode($domDocument, $node);
    }

    /**
     * @inheritdoc
     */
    public function aggregateChildrenContainer(DOMDocument $domDocument, NodeInterface $node)
    {
        return $this->markupDocument->aggregateChildrenContainer($domDocument, $node);
    }

    /**
     * @inheritdoc
     */
    public function aggregateChildNode(DOMDocument $domDocument, NodeInterface $node)
    {
        return $this->markupDocument->aggregateChildNode($domDocument, $node);
    }
}
