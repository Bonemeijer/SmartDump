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

/**
 * Class LightColorSchemeDecorator
 *
 * @package    SmartDump
 * @subpackage Formatter
 */
class LightColorSchemeDecorator extends MarkupDecorator
{
    /** @var MarkupInterface */
    protected $markupDocument;

    /**
     * Constructor
     *
     * @param MarkupInterface $markupDocument
     */
    public function __construct(MarkupInterface $markupDocument)
    {
        $this->markupDocument = $markupDocument;
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

        $element = $domDocument->createElement(
            'style',
            file_get_contents(__DIR__ . '/_resources/light-color-scheme.css')
        );

        $domDocument->appendChild($element);
    }
}
