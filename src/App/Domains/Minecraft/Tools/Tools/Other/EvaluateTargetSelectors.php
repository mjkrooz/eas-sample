<?php namespace App\Domains\Minecraft\Tools\Tools\Other;

use App\Domains\Minecraft\Minecraft;
use App\Domains\Minecraft\Tools\ToolOptions;
use App\Domains\Minecraft\Tools\ToolOutput;
use App\Domains\Minecraft\Tools\Tools\AbstractEvaluationTool;
use App\Domains\Minecraft\Tools\ToolSupervisor;
use Celestriode\ConstructuresMinecraft\Constructures\Minecraft\Bedrock\TargetSelectors as BedrockTargetSelectors;
use Celestriode\ConstructuresMinecraft\Constructures\Minecraft\Java\TargetSelectors as JavaTargetSelectors;

class EvaluateTargetSelectors extends AbstractEvaluationTool
{
    protected function evaluate(ToolSupervisor $supervisor): void
    {
        // Cycle through all advancements.

        if ($supervisor->getOptions()->getOption(ToolOptions::GAME)->getEdition() == Minecraft::BEDROCK) {

            $constructure = BedrockTargetSelectors::getConstructure($supervisor->getEventHandler());
            $expectedStructure = BedrockTargetSelectors::getStructure();
        } else {

            $constructure = JavaTargetSelectors::getConstructure($supervisor->getEventHandler());
            $expectedStructure = JavaTargetSelectors::getStructure();
        }

        while (($input = $supervisor->getNextInput()) !== null) {

            $supervisor->setOutput($input->getId(), new ToolOutput($this->evaluateStructure($supervisor, $constructure, $expectedStructure, $input)));
        }
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'evaluate_target_selectors';
    }
}
