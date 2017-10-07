<?php

namespace SmartDump\Node\Type\ObjectType;

use ReflectionObject;
use SmartDump\Node\NodeFactoryInterface;
use SmartDump\Node\NodeTypeNotSupportedException;
use SmartDump\Node\Type\NodeTypeFactoryInterface;

/**
 * Class ObjectNodeTypeFactory
 *
 * @package SmartDump
 * @subpackage Node
 */
class ObjectNodeTypeFactory implements NodeTypeFactoryInterface
{
    /** @var array */
    protected $objectHashes = [];

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
        return is_object($variable);
    }

    /**
     * @inheritdoc
     */
    public function create($variable)
    {
        if (!$this->supports($variable)) {
            throw NodeTypeNotSupportedException::createFor(gettype($variable), $this);
        }

        $variableClass = get_class($variable);

        // track handled objects to prevent infinite recursion
        $variableObjectHash = spl_object_hash($variable);

        if ($this->hasObjectHash($variableObjectHash)) {
            // This object has already been handled in the parent stack
            $node = new ObjectNodeType();
            $node->setAggregate(false);
            $node->setStringValue($variableClass . ' *RECURSION*');

            return $node;
        }

        $this->addObjectHash($variableObjectHash);

        // add nodes for all object properties
        $node = new ObjectNodeType();
        $node->setStringValue($variableClass);

        $objectReflection = new ReflectionObject($variable);

        foreach ($objectReflection->getProperties() as $property) {
            $property->setAccessible(true);

            // create child node
            $childNode = $this->itemFactory->create(
                $property->getValue($variable)
            );

            $childNode->setName($property->getName());

            $visibility = null;

            if ($property->isPublic()) {
                $childNode->setVisibility(ObjectNodeType::VISIBILITY_PUBLIC);
            } elseif ($property->isProtected()) {
                $childNode->setVisibility(ObjectNodeType::VISIBILITY_PROTECTED);
            } elseif ($property->isPrivate()) {
                $childNode->setVisibility(ObjectNodeType::VISIBILITY_PRIVATE);
            }

            if ($property->isStatic()) {
                $childNode->setStatic(true);
            }

            // add child node
            $node->addChild($childNode);
        }

        $this->removeObjectHash($variableObjectHash);

        return $node;
    }

    /**
     * Check if an object hash is already present
     *
     * @param string $objectHash
     * @return bool
     */
    protected function hasObjectHash($objectHash)
    {
        return in_array($objectHash, $this->objectHashes);
    }

    /**
     * Add an object hash to the stack
     *
     * @param string $objectHash
     * @return void
     */
    protected function addObjectHash($objectHash)
    {
        $this->objectHashes[] = $objectHash;
    }

    /**
     * Remove an object hash from the stack
     *
     * @param string $objectHash
     * @return void
     */
    protected function removeObjectHash($objectHash)
    {
        $this->objectHashes = array_diff($this->objectHashes, [$objectHash]);
    }
}
