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

namespace SmartDump\Dumper\String;

use SmartDump\Dumper\FormatterNotSupportedException;
use SmartDump\Formatter\FormatterInterface;
use SmartDump\Formatter\StringFormatter\StringFormatterInterface;
use SmartDump\Node\NodeInterface;

/**
 * Class OutputStringDumper
 *
 * @package    SmartDump
 * @subpackage Dumper
 */
class OutputStringDumper implements StringDumperInterface
{
    /** @var bool */
    protected $autoExit;

    /** @var bool */
    protected $clearOutputBuffer;

    /**
     * Constructor
     *
     * @param bool $autoExit
     * @param bool $clearOutputBuffer
     */
    public function __construct(
        $autoExit = false,
        $clearOutputBuffer = false
    ) {
        $this->autoExit          = $autoExit;
        $this->clearOutputBuffer = $clearOutputBuffer;
    }

    /**
     * AutoExit accessor
     *
     * @return bool
     */
    public function getAutoExit()
    {
        return $this->autoExit;
    }

    /**
     * AutoExit mutator
     *
     * @param  bool $value
     *
     * @return $this
     */
    public function setAutoExit($value)
    {
        $this->autoExit = $value;

        return $this;
    }

    /**
     * ClearOutputBuffer accessor
     *
     * @return bool
     */
    public function getClearOutputBuffer()
    {
        return $this->clearOutputBuffer;
    }

    /**
     * ClearOutputBuffer mutator
     *
     * @param  bool $value
     *
     * @return $this
     */
    public function setClearOutputBuffer($value)
    {
        $this->clearOutputBuffer = $value;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function dump(NodeInterface $node, FormatterInterface $formatter)
    {
        if (!$formatter instanceof StringFormatterInterface) {
            throw FormatterNotSupportedException::createFor($this, $formatter);
        }

        $output = $formatter->format($node);

        if ($this->getClearOutputBuffer()) {
            $this->clearOutputBuffer();
        }

        echo $output;

        if ($this->getAutoExit()) {
            exit();
        }
    }

    /**
     * Clear all output buffer levels
     *
     * @return void
     */
    protected function clearOutputBuffer()
    {
        if (false !== ob_get_contents()) {
            // There is no way to check if an output buffer is active, so we have
            // to clear regardless wether one's active or not.
            // And since they can be nested, we need to clear them in a loop.
            /** @noinspection PhpUsageOfSilenceOperatorInspection */
            /** @noinspection PhpStatementHasEmptyBodyInspection */
            while (@ob_end_clean()) {
            }
        }
    }
}
