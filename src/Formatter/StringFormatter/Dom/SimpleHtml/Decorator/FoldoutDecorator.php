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

namespace SmartDump\Formatter\StringFormatter\Dom\SimpleHtml\Decorator;

use DOMDocument;
use SmartDump\Formatter\StringFormatter\Dom\MarkupDecorator;
use SmartDump\Formatter\StringFormatter\Dom\MarkupInterface;
use SmartDump\Node\NodeInterface;

/**
 * Class FoldoutDecorator
 *
 * @package    SmartDump
 * @subpackage Formatter
 */
class FoldoutDecorator extends MarkupDecorator
{
    /** @var bool */
    protected static $foldoutByDefault = false;

    /** @var MarkupInterface */
    protected $markupDocument;

    /** @var string */
    protected $namespace;

    /**
     * Constructor
     *
     * @param MarkupInterface $markupDocument
     */
    public function __construct(MarkupInterface $markupDocument)
    {
        $this->markupDocument = $markupDocument;
        $this->namespace = uniqid('', true);
    }

    /**
     * @return bool
     */
    public static function isFoldoutByDefault()
    {
        return self::$foldoutByDefault;
    }

    /**
     * @param bool $foldoutByDefault
     */
    public static function setFoldoutByDefault($foldoutByDefault)
    {
        self::$foldoutByDefault = $foldoutByDefault;
    }

    /**
     * @inheritdoc
     */
    public function getMarkupDocument()
    {
        return $this->markupDocument;
    }

    /**
     * @inheritdoc
     */
    public function appendHead(DOMDocument $domDocument)
    {
        $this->getMarkupDocument()->appendHead($domDocument);

        $element = $domDocument->createElement('style', file_get_contents(__DIR__ . '/_resources/foldout.css'));

        $domDocument->appendChild($element);
    }

    /**
     * @inheritdoc
     */
    public function container(DOMDocument $domDocument, NodeInterface $node)
    {
        $container = parent::container($domDocument, $node);
        $container->setAttribute('data-foldout-namespace', $this->namespace);
        $container->setAttribute('data-foldout-state', (int) self::isFoldoutByDefault());

        return $container;
    }

    /**
     * @inheritdoc
     */
    public function appendFoot(DOMDocument $domDocument)
    {
        $this->getMarkupDocument()->appendFoot($domDocument);

        $scriptContent = file_get_contents(__DIR__ . '/_resources/foldout.js');
        $scriptContent = str_replace('FOLDOUT_NAMESPACE', $this->namespace, $scriptContent);

        $element = $domDocument->createElement('script', $scriptContent);
        $element->setAttribute('type', 'text/javascript');

        $domDocument->appendChild($element);
    }
}
