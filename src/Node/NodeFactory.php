<?php

namespace SmartDump\Node;

use SmartDump\Node\Type\NodeTypeFactoryInterface;

/**
 * Class NodeFactory
 *
 * @package SmartDump
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
