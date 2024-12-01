<?php namespace App\Domains\Minecraft\Tools\Tools\DataPacks;

use App\Domains\Minecraft\Tools\Tools\AbstractEvaluationTool;
use App\Domains\Minecraft\Tools\ToolSupervisor;

class EvaluateAdvancements extends AbstractEvaluationTool
{
    public function evaluate(ToolSupervisor $supervisor): void
    {

    }

    public function getName(): string
    {
        return 'evaluate_advancements';
    }
}
