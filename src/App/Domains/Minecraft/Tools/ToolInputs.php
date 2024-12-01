<?php namespace App\Domains\Minecraft\Tools;

use App\Domains\SourceBlock\DataStructures\CountableArrayAccessTrait;
use ArrayAccess;
use Countable;

/**
 * A collection of tool inputs used by tools.
 */
class ToolInputs implements ArrayAccess, Countable
{
    use CountableArrayAccessTrait;

    /**
     * @inheritDoc
     */
    public function validInput(mixed $value): bool
    {
        return $value instanceof ToolInput;
    }
}
