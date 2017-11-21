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

namespace SmartDump\Node;

use SmartDump\Node\Type\NodeTypeFactoryInterface;

/**
 * Class NodeFactory
 *
 * @package    SmartDump
 * @subpackage Node
 */
class NodeFactory implements NodeFactoryInterface
{
    const DEFAULT_MAX_DEPTH = 5;

    /** @var int|null */
    protected $maxDepth = self::DEFAULT_MAX_DEPTH;

    /** @var NodeTypeFactoryInterface[] */
    protected $typeFactories = [];

    /**
     * Constructor
     *
     * @param int|null $maxDepth
     */
    public function __construct($maxDepth = self::DEFAULT_MAX_DEPTH)
    {
        $this->maxDepth = $maxDepth;
    }

    /**
     * MaxDepth mutator
     *
     * @param int|null $value
     * @return $this
     */
    public function setMaxDepth($value)
    {
        $this->maxDepth = $value;

        foreach ($this->getTypeFactories() as $typeFactory) {
            $typeFactory->setMaxDepth($value);
        }

        return $this;
    }

    /**
     * Add type factory
     *
     * @param NodeTypeFactoryInterface $typeFactory
     * @return void
     */
    public function addTypeFactory(NodeTypeFactoryInterface $typeFactory)
    {
        $typeFactory->setMaxDepth($this->maxDepth);

        array_unshift($this->typeFactories, $typeFactory);
    }

    /**
     * TypeFactories accessor
     *
     * @return NodeTypeFactoryInterface[]
     */
    public function getTypeFactories()
    {
        return $this->typeFactories;
    }

    /**
     * @inheritdoc
     */
    public function create($variable, $currentDepth = 0)
    {
        foreach ($this->getTypeFactories() as $typeFactory) {
            if ($typeFactory->supports($variable)) {
                return $typeFactory->create($variable, $currentDepth);
            }
        }

        throw NodeNotSupportedException::createFor($variable);
    }
}
