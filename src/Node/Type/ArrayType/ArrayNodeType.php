<?php

namespace SmartDump\Node\Type\ArrayType;

use SmartDump\Node\Type\NodeType;

/**
 * Class ArrayNodeType
 *
 * @package SmartDump
 * @subpackage Node
 */
class ArrayNodeType extends NodeType
{
    /** @var string */
    protected $stringValue = 'Array';

    /** @var bool */
    protected $aggregate = true;
}
