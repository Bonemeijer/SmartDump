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
    /** @var NodeTypeFactoryInterface[] */
    protected $typeFactories = [];

    /**
     * Add type factory
     *
     * @param NodeTypeFactoryInterface $typeFactory
     * @return void
     */
    public function addTypeFactory(NodeTypeFactoryInterface $typeFactory)
    {
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
    public function create($variable)
    {
        foreach ($this->getTypeFactories() as $typeFactory) {
            if ($typeFactory->supports($variable)) {
                return $typeFactory->create($variable);
            }
        }

        throw NodeNotSupportedException::createFor($variable);
    }
}
