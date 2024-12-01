<?php namespace App\Domains\Minecraft\Tools\Tools;

use App\Domains\Minecraft\Minecraft;
use App\Domains\Minecraft\Registries\StandardPopulators;
use App\Domains\Minecraft\Tools\ToolInput;
use App\Domains\Minecraft\Tools\ToolInputs;
use App\Domains\Minecraft\Tools\ToolInterface;
use App\Domains\Minecraft\Tools\ToolOptions;
use App\Domains\Minecraft\Tools\ToolSupervisor;
use Celestriode\DynamicRegistry\Exception\InvalidValue;
use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;

abstract class AbstractEvaluationTool extends AbstractTool
{
    use EvaluateTrait;

    /**
     * @inheritDoc
     */
    public static function buildOptions(FormRequest $request): ToolOptions
    {
        $options = new ToolOptions();
        $data = $request->validated();

        $minecraft = new Minecraft(
            Uuid::fromString($data['options']['game']['edition'] ?? ToolOptions::GAME_EDITION_DEFAULT),
            Uuid::fromString($data['options']['game']['version'] ?? ToolOptions::GAME_VERSION_DEFAULT)
        );

        $options->setOption(ToolOptions::FEEDBACK, $data['options']['feedback'] ?? ToolOptions::FEEDBACK_DEFAULT);
        $options->setOption(ToolOptions::STATISTICS, $data['options']['statistics'] ?? ToolOptions::STATISTICS_DEFAULT);
        $options->setOption(ToolOptions::COMPONENTS, $data['options']['components'] ?? ToolOptions::COMPONENTS_DEFAULT);
        $options->setOption(ToolOptions::DEBUG, false/*$data['options']['debug'] ?? ToolOptions::DEBUG_DEFAULT*/); // TODO: allow support.
        $options->setOption(ToolOptions::GAME, $minecraft);

        return $options;
    }

    /**
     * @inheritDoc
     */
    public static function buildInputs(FormRequest $request): ToolInputs
    {
        $data = $request->validated();
        $inputs = new ToolInputs();

        // If only a string was provided, return just that string.

        if (is_string($data['structure'])) {

            $inputs[] = new ToolInput('0', $data['structure']);

            return $inputs;
        }

        // Otherwise, if an array or object was provided, use that.

        foreach ($data['structure'] as $key => $input) {

            $inputs[$key] = new ToolInput($key, $input);
        }

        return $inputs;
    }

    /**
     * @throws InvalidValue
     */
    public function runTool(ToolSupervisor $supervisor): void
    {
        // Register standard populators.

        StandardPopulators::register($supervisor->getOptions()->getOption(ToolOptions::GAME));

        // Evaluate.

        $this->evaluate($supervisor);
    }

    abstract protected function evaluate(ToolSupervisor $supervisor): void;

    /**
     * @inheritDoc
     */
    public function getCategory(): int
    {
        return ToolInterface::EVALUATOR;
    }
}
