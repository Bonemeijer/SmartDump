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

namespace SmartDump\Node\Type\DateTimeType;

use SmartDump\Node\NodeFactoryInterface;
use SmartDump\Node\NodeTypeNotSupportedException;
use SmartDump\Node\Type\NodeTypeFactory;

/**
 * Class DateTimeNodeTypeFactory
 *
 * @package    SmartDump
 * @subpackage Node
 */
class DateTimeNodeTypeFactory extends NodeTypeFactory
{
    /** @var NodeFactoryInterface */
    protected $itemFactory;

    /**
     * Constructor
     *
     * @param NodeFactoryInterface $itemFactory
     */
    public function __construct(NodeFactoryInterface $itemFactory)
    {
        $this->itemFactory = $itemFactory;
    }

    /**
     * @inheritdoc
     */
    public function supports($variable)
    {
        return $variable instanceof \DateTime;
    }

    /**
     * @inheritdoc
     */
    public function create($variable, $currentDepth = 0)
    {
        if (!$variable instanceof \DateTime) {
            throw NodeTypeNotSupportedException::createFor(gettype($variable), $this);
        }

        // add nodes for all array items
        $node = new DateTimeNodeType();
        $node->setStringValue('');

        $nodeData = [
            'date'     => $variable->format('d-m-y H:I;s.u'),
            'timezone' => $variable->getTimezone()->getName(),
        ];

        foreach ($nodeData as $key => $item) {
            $childNode = $this->itemFactory->create($item, $currentDepth + 1);
            $childNode->setName($key);

            $node->addChild($childNode);
        }

        return $node;
    }
}
