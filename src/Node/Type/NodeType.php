<?php

namespace SmartDump\Node\Type;

use SmartDump\Node\NodeInterface;

/**
 * Class NodeType
 *
 * @package SmartDump
 */
class NodeType implements NodeInterface
{
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
}
