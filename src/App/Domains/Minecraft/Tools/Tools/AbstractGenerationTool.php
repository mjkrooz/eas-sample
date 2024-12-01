<?php namespace App\Domains\Minecraft\Tools\Tools;

use App\Domains\Minecraft\Tools\ToolInterface;

abstract class AbstractGenerationTool extends AbstractTool
{
    /**
     * @inheritDoc
     */
    public function getCategory(): int
    {
        return ToolInterface::GENERATOR;
    }
}
