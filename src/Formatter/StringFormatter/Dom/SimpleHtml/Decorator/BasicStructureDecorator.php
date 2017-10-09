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
 * Class BasicStructureDecorator
 *
 * @package    SmartDump
 * @subpackage Formatter
 */
class BasicStructureDecorator extends MarkupDecorator
{
    /**
     * @inheritdoc
     */
    public function appendHead(DOMDocument $domDocument)
    {
        $this->markupDocument->appendHead($domDocument);

        $element = $domDocument->createElement(
            'style',
            <<<STYLE
#smartdump-simplehtml {
    text-align: left; 
    font-family: Courier,monospace;
    font-size: 14px; 
    line-height: 16px; 
    padding: 10px;
}

#smartdump-simplehtml .scalar-node {
    float: left;
}

#smartdump-simplehtml .aggregate-node {
}

#smartdump-simplehtml .aggregate-node-name {
}

#smartdump-simplehtml .aggregate-children-container {
    padding-left: 0;
}

#smartdump-simplehtml .aggregate-children-container .aggregate-children-container {
    padding-left: 34px;
}

#smartdump-simplehtml .aggregate-children-container:before {
    display: block;
    content: "(";
}

#smartdump-simplehtml .aggregate-children-container:after {
    display: block;
    content: ")";         
}

#smartdump-simplehtml .aggregate-child-node {
    overflow: auto;
    padding-left: 34px;
}

#smartdump-simplehtml .aggregate-child-name {
    float:left;
    overflow: auto;
}

#smartdump-simplehtml .aggregate-child-name:before {
    float: left;
    content: "[";
}

#smartdump-simplehtml .aggregate-child-name:after {
    float: left;
    content: "]";
}

#smartdump-simplehtml .aggregate-child-name span {
    float: left;
}

#smartdump-simplehtml .aggregate-child-name .visibility:before {
    content: ":";
}

#smartdump-simplehtml .aggregate-child-name .static:before {
    content: ":";
}

#smartdump-simplehtml .aggregate-child-name-separator {
    float: left;
    margin: 0 8px;
}

/* Specific node types */
#smartdump-simplehtml .string-node:before {
    content: "\"";
}

#smartdump-simplehtml .string-node:after {
    content: "\"";
}

#smartdump-simplehtml .boolean-node,
#smartdump-simplehtml .null-node {
    text-transform: uppercase;
}
STYLE
        );

        $domDocument->appendChild($element);
    }
}
