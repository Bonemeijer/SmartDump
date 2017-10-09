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

namespace SmartDump;

use SmartDump\Dumper\DumperInterface;
use SmartDump\Dumper\OutputDumper;
use SmartDump\Formatter\FormatterInterface;
use SmartDump\Formatter\StringFormatter\DefaultCallbackStringFormatter;
use SmartDump\Node\DefaultNodeFactory;
use SmartDump\Node\NodeFactoryInterface;

/**
 * Class SmartDump
 *
 * Provides a friendly interface for quickly configuring and dumping variables.
 *
 * @package SmartDump
 */
class SmartDump
{
    /** @var NodeFactoryInterface */
    protected static $nodeFactory;

    /** @var FormatterInterface */
    protected static $formatter;

    /** @var DumperInterface */
    protected static $dumper;

    /**
     * NodeFactory accessor
     *
     * @return NodeFactoryInterface
     */
    public static function getNodeFactory()
    {
        if (null === self::$nodeFactory) {
            self::$nodeFactory = new DefaultNodeFactory();
        }

        return self::$nodeFactory;
    }

    /**
     * NodeFactory mutator
     *
     * @param  NodeFactoryInterface $nodeFactory
     * @return void
     */
    public static function setNodeFactory(NodeFactoryInterface $nodeFactory)
    {
        self::$nodeFactory = $nodeFactory;
    }

    /**
     * Formatter accessor
     *
     * @return FormatterInterface
     */
    public static function getFormatter()
    {
        if (null === self::$formatter) {
            self::$formatter = new DefaultCallbackStringFormatter();
        }

        return self::$formatter;
    }

    /**
     * Formatter mutator
     *
     * @param  FormatterInterface $formatter
     * @return void
     */
    public static function setFormatter(FormatterInterface $formatter)
    {
        self::$formatter = $formatter;
    }

    /**
     * Dumper accessor
     *
     * @return DumperInterface
     */
    public static function getDumper()
    {
        if (null === self::$dumper) {
            self::$dumper = new OutputDumper();
        }

        return self::$dumper;
    }

    /**
     * Dumper mutator
     *
     * @param  DumperInterface $dumper
     * @return void
     */
    public static function setDumper(DumperInterface $dumper)
    {
        self::$dumper = $dumper;
    }

    /**
     * Dump a variable
     *
     * @param mixed $variable
     * @return void
     */
    public static function dump($variable)
    {
        self::getDumper()->dump(
            self::getNodeFactory()->create($variable),
            self::getFormatter()
        );
    }
}
