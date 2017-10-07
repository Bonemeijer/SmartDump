<?php

namespace SmartDump\Node\Type\ObjectType;

use SmartDump\Node\Type\NodeType;

/**
 * Class ObjectNodeType
 *
 * @package SmartDump
 * @subpackage Node
 */
class ObjectNodeType extends NodeType
{
    const SCOPE_STATIC = 'static';

    const VISIBILITY_PUBLIC    = 'public';
    const VISIBILITY_PROTECTED = 'protected';
    const VISIBILITY_PRIVATE   = 'private';

    /** @var string */
    protected $stringValue = 'Object';

    /** @var bool */
    protected $aggregate = true;
}
