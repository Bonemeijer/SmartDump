<?php
/**
 * MIT License
 *
 * Copyright (c) 2008-2017 OMNIDUMP
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
