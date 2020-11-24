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

use SmartDump\Node\Type\ArrayType\ArrayNodeTypeFactory;
use SmartDump\Node\Type\BooleanType\BooleanNodeTypeFactory;
use SmartDump\Node\Type\DateTimeType\DateTimeNodeTypeFactory;
use SmartDump\Node\Type\FloatType\FloatNodeTypeFactory;
use SmartDump\Node\Type\IntegerType\IntegerNodeTypeFactory;
use SmartDump\Node\Type\NullType\NullNodeTypeFactory;
use SmartDump\Node\Type\ObjectType\ObjectNodeTypeFactory;
use SmartDump\Node\Type\ResourceType\ResourceNodeTypeFactory;
use SmartDump\Node\Type\StringType\StringNodeTypeFactory;

/**
 * Class DefaultNodeFactory
 *
 * @package    SmartDump
 * @subpackage Node
 */
class DefaultNodeFactory extends NodeFactory
{
    /**
     * Constructor
     * Adds default supported node type factories
     *
     * @param int $maxDepth
     */
    public function __construct($maxDepth = NodeFactory::DEFAULT_MAX_DEPTH)
    {
        parent::__construct($maxDepth);

        // scalar types
        $this->addTypeFactory(new BooleanNodeTypeFactory());
        $this->addTypeFactory(new FloatNodeTypeFactory());
        $this->addTypeFactory(new IntegerNodeTypeFactory());
        $this->addTypeFactory(new NullNodeTypeFactory());
        $this->addTypeFactory(new ResourceNodeTypeFactory());
        $this->addTypeFactory(new StringNodeTypeFactory());

        // special types
        $this->addTypeFactory(new DateTimeNodeTypeFactory($this));

        // aggregate types
        $this->addTypeFactory(new ArrayNodeTypeFactory($this));
        $this->addTypeFactory(new ObjectNodeTypeFactory($this));
    }
}
