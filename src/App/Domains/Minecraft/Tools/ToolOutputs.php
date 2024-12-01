<?php namespace App\Domains\Minecraft\Tools;

use App\Domains\SourceBlock\DataStructures\CountableArrayAccessTrait;
use ArrayAccess;
use Countable;

class ToolOutputs implements ArrayAccess, Countable
{
    use CountableArrayAccessTrait;

    /**
     * @inheritDoc
     */
    public function validInput(mixed $value): bool
    {
        return $value instanceof ToolOutput;
    }
}
