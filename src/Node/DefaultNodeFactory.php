<?php

namespace SmartDump\Node;

use SmartDump\Node\Type\ArrayType\ArrayNodeTypeFactory;
use SmartDump\Node\Type\BooleanType\BooleanNodeTypeFactory;
use SmartDump\Node\Type\FloatType\FloatNodeTypeFactory;
use SmartDump\Node\Type\IntegerType\IntegerNodeTypeFactory;
use SmartDump\Node\Type\NullType\NullNodeTypeFactory;
use SmartDump\Node\Type\ObjectType\ObjectNodeTypeFactory;
use SmartDump\Node\Type\ResourceType\ResourceNodeTypeFactory;
use SmartDump\Node\Type\StringType\StringNodeTypeFactory;

/**
 * Class DefaultNodeFactory
 *
 * @package SmartDump
 * @subpackage Node
 */
class DefaultNodeFactory extends NodeFactory
{
    /**
     * Constructor
     * Adds default supported node type factories
     */
    public function __construct()
    {
        // scalar types
        $this->addTypeFactory(new BooleanNodeTypeFactory());
        $this->addTypeFactory(new FloatNodeTypeFactory());
        $this->addTypeFactory(new IntegerNodeTypeFactory());
        $this->addTypeFactory(new NullNodeTypeFactory());
        $this->addTypeFactory(new ResourceNodeTypeFactory());
        $this->addTypeFactory(new StringNodeTypeFactory());

        // aggregate types
        $this->addTypeFactory(new ArrayNodeTypeFactory($this));
        $this->addTypeFactory(new ObjectNodeTypeFactory($this));
    }
}
