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

/**
 * Class LightColorSchemeDecorator
 *
 * @package    SmartDump
 * @subpackage Formatter
 */
class LightColorSchemeDecorator extends MarkupDecorator
{
    /**
     * @inheritdoc
     */
    public function appendHead(DOMDocument $domDocument)
    {
        $this->markupDocument->appendHead($domDocument);

        $element = $domDocument->createElement(
            'style',
            '
            #smartdump-simplehtml {
                background: #FFF; 
                color: #000;
            }
            
            #smartdump-simplehtml .aggregate-child-name .visibility {
                color: #999;
            }
            
            #smartdump-simplehtml .aggregate-child-name .static {
                color: #999;
            }
            
            #smartdump-simplehtml .string-node {
                color: #10720E;
            }
            
            #smartdump-simplehtml .boolean-node,
            #smartdump-simplehtml .null-node,
            #smartdump-simplehtml .resource-node {
                color: #860088;
            }
        '
        );

        $domDocument->appendChild($element);
    }
}
