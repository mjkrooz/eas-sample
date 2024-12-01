<?php namespace App\Domains\Minecraft\Tools\Tools\Other;

use App\Domains\Minecraft\Minecraft;
use App\Domains\Minecraft\Tools\ToolInterface;
use App\Domains\Minecraft\Tools\ToolOptions;
use App\Domains\Minecraft\Tools\ToolOutput;
use App\Domains\Minecraft\Tools\Tools\AbstractEvaluationTool;
use App\Domains\Minecraft\Tools\ToolSupervisor;
use Celestriode\ConstructuresMinecraft\Constructures\Minecraft\Bedrock\TextComponents as BedrockTextComponents;
use Celestriode\ConstructuresMinecraft\Constructures\Minecraft\Java\TextComponents as JavaTextComponents;
use Celestriode\JsonConstructure\Context\Audits\TypesMatch;
use Celestriode\JsonConstructure\JsonConstructure;

class EvaluateTextComponents extends AbstractEvaluationTool
{
    public function evaluate(ToolSupervisor $supervisor): void
    {
        // Cycle through all advancements.

        $constructure = new JsonConstructure($supervisor->getEventHandler(), new TypesMatch());

        if ($supervisor->getOptions()->getOption(ToolOptions::GAME)->getEdition() == Minecraft::BEDROCK) {

            $expectedStructure = BedrockTextComponents::getStructure();
        } else {

            $expectedStructure = JavaTextComponents::getStructure();
        }

        while (($input = $supervisor->getNextInput()) !== null) {

            $supervisor->setOutput($input->getId(), new ToolOutput($this->evaluateStructure($supervisor, $constructure, $expectedStructure, $input)));
        }
    }

    public function getCategory(): int
    {
        return ToolInterface::OTHER;
    }

    public function getName(): string
    {
        return 'evaluate_text_components';
    }
}
