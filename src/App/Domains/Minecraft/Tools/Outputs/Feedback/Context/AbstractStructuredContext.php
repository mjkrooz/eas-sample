<?php namespace App\Domains\Minecraft\Tools\Outputs\Feedback\Context;

use Celestriode\Constructure\Structures\StructureInterface;
use Celestriode\JsonConstructure\Structures\AbstractJsonStructure;

abstract class AbstractStructuredContext extends AbstractContext
{
    /**
     * @param StructureInterface $structure The structure to use for context.
     * @param string ...$contexts Additional strings to use for context.
     * @return AbstractStructuredContext
     */
    final public static function create(StructureInterface $structure, string ...$contexts): AbstractStructuredContext
    {
        if ($structure instanceof AbstractJsonStructure) {

            return new JsonContext($structure);
        }

        return new StructureContext($structure);
    }
}
