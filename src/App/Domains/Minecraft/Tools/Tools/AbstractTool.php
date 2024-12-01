<?php namespace App\Domains\Minecraft\Tools\Tools;

use App\Domains\Minecraft\Minecraft;
use App\Domains\Minecraft\Tools\ToolInputs;
use App\Domains\Minecraft\Tools\ToolInterface;
use App\Domains\Minecraft\Tools\ToolOptions;
use App\Domains\Minecraft\Tools\ToolSupervisor;
use Celestriode\Constructure\Context\Events\EventHandler;
use Illuminate\Foundation\Http\FormRequest;

abstract class AbstractTool implements ToolInterface
{
    /**
     * @inheritDoc
     */
    public static function register(): ?self
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public static function buildOptions(FormRequest $request): ToolOptions
    {
        return new ToolOptions();
    }

    /**
     * @inheritDoc
     */
    public static function buildInputs(FormRequest $request): ToolInputs
    {
        return new ToolInputs();
    }

    /**
     * @inheritDoc
     */
    public static function buildOutputs(ToolSupervisor $supervisor): void
    {
    }

    /**
     * @inheritDoc
     */
    public static function buildSupervisor(FormRequest $request): ToolSupervisor
    {
        $options = static::buildOptions($request);
        $inputs = static::buildInputs($request);
        $supervisor = new ToolSupervisor($options, $inputs);
        $supervisor->setEventHandler(new EventHandler());

        static::buildOutputs($supervisor);

        return $supervisor;
    }

    /**
     * @inheritDoc
     */
    public static function getRequiredRegistries(Minecraft $minecraft): array
    {
        return [];
    }
}
