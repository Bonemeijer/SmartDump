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

/**
 * Shortcut function for SmartDump::dump()
 *
 * @param mixed $variable
 * @return void
 */
function smartdump($variable)
{
    \SmartDump\SmartDump::dump($variable);
}

/**
 * Dump plaintext to output
 *
 * Uses DefaultNodeFactory, OutputDumper, PlainTextStringFormatter
 *
 * @param mixed $variable
 * @param int   $maxDepth
 * @return void
 */
function smartdump_text($variable, $maxDepth = \SmartDump\Node\NodeFactory::DEFAULT_MAX_DEPTH)
{
    $nodeFactory = new \SmartDump\Node\DefaultNodeFactory($maxDepth);
    $dumper      = new \SmartDump\Dumper\OutputDumper();

    $dumper->dump(
        $nodeFactory->create($variable),
        new \SmartDump\Formatter\StringFormatter\PlainTextStringFormatter()
    );
}

/**
 * Dump html to output
 *
 * Uses DefaultNodeFactory, OutputDumper, DomStringFormatter & SimpleHtmlMarkupConfigurator
 *
 * @param mixed $variable
 * @param int   $maxDepth
 * @return void
 */
function smartdump_html($variable, $maxDepth = \SmartDump\Node\NodeFactory::DEFAULT_MAX_DEPTH)
{
    $nodeFactory = new \SmartDump\Node\DefaultNodeFactory();
    $dumper      = new \SmartDump\Dumper\OutputDumper();

    $dumper->dump(
        $nodeFactory->create($variable),
        new \SmartDump\Formatter\StringFormatter\DomStringFormatter(
            new \SmartDump\Formatter\StringFormatter\Dom\SimpleHtml\SimpleHtmlMarkupConfigurator()
        )
    );
}

/**
 * Dump plaintext to a stream
 *
 * Uses DefaultNodeFactory, OutputDumper, PlainTextStringFormatter
 *
 * @param mixed  $variable
 * @param string $target
 * @param int    $maxDepth
 * @return void
 */
function smartdump_text_stream($variable, $target, $maxDepth = \SmartDump\Node\NodeFactory::DEFAULT_MAX_DEPTH)
{
    $nodeFactory = new \SmartDump\Node\DefaultNodeFactory($maxDepth);
    $dumper      = new \SmartDump\Dumper\StreamDumper($target);

    $dumper->dump(
        $nodeFactory->create($variable),
        new \SmartDump\Formatter\StringFormatter\PlainTextStringFormatter()
    );
}

if (!function_exists('d')) {
    /**
     * Dump a variable inline (without clearing output buffer or exiting)
     * Uses DefaultNodeFactory, OutputDumper, ContextAwareStringFormatter
     *
     * @param mixed $variable
     * @param int   $maxDepth
     * @return void
     */
    function d($variable, $maxDepth = \SmartDump\Node\NodeFactory::DEFAULT_MAX_DEPTH)
    {
        $nodeFactory = new \SmartDump\Node\DefaultNodeFactory($maxDepth);
        $dumper      = new \SmartDump\Dumper\OutputDumper();

        $dumper->dump(
            $nodeFactory->create($variable),
            new \SmartDump\Formatter\StringFormatter\ContextAwareStringFormatter()
        );
    }
}

if (!function_exists('o')) {
    /**
     * Output a variable (with clearing output buffer and exiting)
     * Uses DefaultNodeFactory, OutputDumper, ContextAwareStringFormatter
     *
     * @param mixed $variable
     * @param int   $maxDepth
     * @return void
     */
    function o($variable, $maxDepth = \SmartDump\Node\NodeFactory::DEFAULT_MAX_DEPTH)
    {
        $nodeFactory = new \SmartDump\Node\DefaultNodeFactory($maxDepth);
        $dumper      = new \SmartDump\Dumper\OutputDumper(true, true);

        $dumper->dump(
            $nodeFactory->create($variable),
            new \SmartDump\Formatter\StringFormatter\ContextAwareStringFormatter()
        );
    }
}
