<?php namespace App\Domains\Minecraft\Tools;

use App\Domains\Minecraft\Minecraft;
use Illuminate\Foundation\Http\FormRequest;

interface ToolInterface
{
    public const EVALUATOR = 1;
    public const GENERATOR = 2;
    public const OTHER = 3;

    /**
     * Performs any extra registration steps necessary. Can either return a new instance of the tool or null. If null is
     * returned, a new instance of the tool is created only when the tool is requested.
     *
     * @return static|null
     */
    public static function register(): ?self;

    /**
     * Creates and returns a new ToolOptions object for the tool, which is used by the supervisor.
     *
     * @param FormRequest $request
     * @return ToolOptions
     */
    public static function buildOptions(FormRequest $request): ToolOptions;

    /**
     * Creates and returns an array of ToolInput objects for the tool, which is used by the supervisor.
     *
     * @param FormRequest $request
     * @return ToolInputs
     */
    public static function buildInputs(FormRequest $request): ToolInputs;

    /**
     * Creates and adds ToolOutput objects for the tool, if applicable, which is used by the supervisor.
     *
     * @param ToolSupervisor $supervisor
     * @return void
     */
    public static function buildOutputs(ToolSupervisor $supervisor): void;

    /**
     * Creates a supervisor with the context of the specific tool.
     *
     * @param FormRequest $request
     * @return ToolSupervisor
     */
    public static function buildSupervisor(FormRequest $request): ToolSupervisor;

    /**
     * Runs the tool using the supplied supervisor.
     *
     * @param ToolSupervisor $supervisor
     * @return void
     */
    public function runTool(ToolSupervisor $supervisor): void;

    /**
     * Simply returns a list of registry class names that the tool may use.
     *
     * @param Minecraft $minecraft The Minecraft edition/version that can decide which registries are used.
     * @return string[]
     */
    public static function getRequiredRegistries(Minecraft $minecraft): array;

    /**
     * Returns the category ID that the tool should appear under for views.
     *
     * @return int
     */
    public function getCategory(): int;

    /**
     * Returns the name ID of the tool, which is used for views.
     *
     * @return string
     */
    public function getName(): string;
}
