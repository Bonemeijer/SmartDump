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

namespace SmartDump\Node\Type;

use SmartDump\Node\NodeInterface;

/**
 * Class NodeType
 *
 * @package SmartDump
 */
class NodeType implements NodeInterface
{
    const TYPE = 'node';

    /** @var array */
    protected $types = [self::TYPE];

    /** @var null|string */
    protected $name;

    /** @var null|string */
    protected $visibility;

    /** @var bool */
    protected $static = false;

    /** @var string */
    protected $stringValue = '';

    /** @var bool */
    protected $aggregate = false;

    /** @var NodeInterface[] */
    protected $children = [];

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function setName($value)
    {
        $this->name = $value;
    }

    /**
     * @inheritdoc
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

    /**
     * @inheritdoc
     */
    public function setVisibility($value)
    {
        $this->visibility = $value;
    }

    /**
     * @inheritdoc
     */
    public function isStatic()
    {
        return $this->static;
    }

    /**
     * @inheritdoc
     */
    public function setStatic($static)
    {
        $this->static = (bool) $static;
    }

    /**
     * @inheritdoc
     */
    public function getStringValue()
    {
        return $this->stringValue;
    }

    /**
     * StringValue mutator
     *
     * @param string $value
     * @return void
     */
    public function setStringValue($value)
    {
        $this->stringValue = $value;
    }

    /**
     * @inheritdoc
     */
    public function isAggregate()
    {
        return $this->aggregate;
    }

    /**
     * Aggregate mutator
     *
     * @param bool $value
     * @return void
     */
    public function setAggregate($value)
    {
        $this->aggregate = $value;
    }

    /**
     * @inheritdoc
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Add child node
     *
     * @param NodeInterface $nodeType
     * @return void
     */
    public function addChild(NodeInterface $nodeType)
    {
        $this->children[] = $nodeType;
    }

    /**
     * @inheritdoc
     */
    public function getTypes()
    {
        return $this->types;
    }
}
