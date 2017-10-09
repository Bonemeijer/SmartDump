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

use SmartDump\Node\NodeInterface;

/**
 * Class PlainTextStringFormatter
 *
 * @package    SmartDump
 * @subpackage Formatter
 */
class PlainTextStringFormatter implements StringFormatterInterface
{
    const DEFAULT_INDENTATION_STRING = '    ';

    /** @var string */
    protected $indentationString;

    /**
     * Constructor
     *
     * @param string $indentationString
     */
    public function __construct(
        $indentationString = self::DEFAULT_INDENTATION_STRING
    ) {
        $this->indentationString = $indentationString;
    }

    /**
     * @inheritdoc
     */
    public function format(NodeInterface $node)
    {
        $output = $this->formatNode($node);

        // always end with a newline
        $output .= PHP_EOL;

        return $output;
    }

    /**
     * Format a node to string
     *
     * @param NodeInterface $node
     * @param int           $currentDepth
     * @return string
     */
    protected function formatNode(NodeInterface $node, $currentDepth = 0)
    {
        if ($node->isAggregate()) {
            return $this->formatAggregateNode($node, $currentDepth);
        }

        return $this->formatScalarNode($node);
    }

    /**
     * Format a scalar node to string
     *
     * @param NodeInterface $node
     * @return string
     */
    protected function formatScalarNode(NodeInterface $node)
    {
        return $node->getStringValue();
    }

    /**
     * Format an aggregate node to string
     *
     * @param NodeInterface $node
     * @param int           $currentDepth
     * @return string
     */
    protected function formatAggregateNode(NodeInterface $node, $currentDepth = 0)
    {
        $output = '';
        $output .= $node->getStringValue() . ' (' . PHP_EOL;

        foreach ($node->getChildren() as $key => $childNode) {
            $childName       = $childNode->getName();
            $childVisibility = $childNode->getVisibility();

            if (null !== $childVisibility) {
                $childName .= ':' . $childVisibility;
            }

            if ($childNode->isStatic()) {
                $childName .= ':static';
            }

            $output .= $this->renderIndentation($currentDepth + 1);
            $output .= sprintf('[%s]', $childName);
            $output .= ' => ';
            $output .= $this->formatNode($childNode, $currentDepth + 1);
            $output .= PHP_EOL;
        }

        $output .= $this->renderIndentation($currentDepth) . ')';

        return $output;
    }

    /**
     * Render indentation
     *
     * @param int $level
     * @return string
     */
    protected function renderIndentation($level)
    {
        return str_repeat($this->indentationString, $level);
    }
}
