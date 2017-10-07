<?php

namespace SmartDump\Node;

/**
 * Interface NodeInterface
 *
 * @package SmartDump
 * @subpackage Node
 */
interface NodeInterface
{
    /**
     * Get node name
     *
     * @return null|string
     */
    public function getName();

    /**
     * Set node name
     *
     * @param null|string $name
     * @return void
     */
    public function setName($name);

    /**
     * Get node visibility
     *
     * @return null|string
     */
    public function getVisibility();

    /**
     * Set node visibility
     *
     * @param null|string $visibility
     * @return void
     */
    public function setVisibility($visibility);

    /**
     * Get if node is static
     *
     * @return bool
     */
    public function isStatic();

    /**
     * Set if node is static
     *
     * @param bool $static
     * @return void
     */
    public function setStatic($static);

    /**
     * Get node value as string
     *
     * @return string
     */
    public function getStringValue();

    /**
     * Return wether or not this node is an aggregate
     *
     * @return bool
     */
    public function isAggregate();

    /**
     * Get this node's children
     *
     * @return NodeInterface[]
     */
    public function getChildren();
}
