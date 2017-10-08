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

namespace SmartDump\Formatter\StringFormatter;

use SmartDump\Formatter\StringFormatter\Callback\NoFormatterFoundException;
use SmartDump\Formatter\StringFormatter\Callback\NotAStringFormatterException;
use SmartDump\Node\NodeInterface;

/**
 * Class CallbackStringFormatter
 *
 * @package    SmartDump
 * @subpackage Formatter
 */
class CallbackStringFormatter implements StringFormatterInterface
{
    /** @var callable[] */
    protected $callbacks = [];

    /**
     * Callbacks accessor
     *
     * @return callable[]
     */
    public function getCallbacks()
    {
        return $this->callbacks;
    }

    /**
     * Add a callback (FILA)
     *
     * A callback should return null or a StringFormatter.
     *
     * @param callable $callback
     * @return $this
     */
    public function addCallback(callable $callback)
    {
        array_unshift($this->callbacks, $callback);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function format(NodeInterface $node)
    {
        foreach ($this->getCallbacks() as $callback) {
            $formatter = $callback();

            if (null === $formatter
                || false === $formatter
            ) {
                continue;
            }

            if ($formatter instanceof StringFormatterInterface) {
                return $formatter->format($node);
            }

            throw NotAStringFormatterException::create();
        }

        throw NoFormatterFoundException::create();
    }
}
