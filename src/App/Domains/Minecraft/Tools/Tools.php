<?php namespace App\Domains\Minecraft\Tools;

use App\Domains\Minecraft\Tools\Tools\DataPacks\EvaluateAdvancements;
use App\Domains\Minecraft\Tools\Tools\DataPacks\RaycastingGenerator;
use App\Domains\Minecraft\Tools\Tools\Other\EvaluateTextComponents;
use RuntimeException;

final class Tools
{
    /**
     * @var array List of registered tools. Any be null until the tool is requested.
     */
    protected static array $tools = [];

    /**
     * Registers official tools. These will automatically be added to the Tools page.
     *
     * @return void
     */
    public static function registerTools(): void
    {
        self::registerTool(EvaluateTextComponents::class);
        self::registerTool(EvaluateAdvancements::class);
        self::registerTool(RaycastingGenerator::class);
    }

    /**
     * Registers a single tool.
     *
     * @param string $className The class name of the tool to register.
     * @return void
     */
    private static function registerTool(string $className): void
    {
        if (!is_subclass_of($className, ToolInterface::class)) {

            throw new RuntimeException('Tool "' . $className . '" is not a valid tool');
        }

        self::$tools[$className] = $className::register();
    }

    /**
     * Returns a singleton of the requested tool.
     *
     * @param string $className The class name of the tool to get.
     * @param mixed ...$inputs
     * @return ToolInterface
     */
    public static function getTool(string $className, mixed ...$inputs): ToolInterface
    {
        if (!array_key_exists($className, self::$tools)) {

            throw new RuntimeException('Tool "' . $className . '" is not registered');
        }

        // If inputs were specified, do not use or create a singleton.

        if (!empty($inputs)) {

            return new $className(...$inputs);
        }

        // Otherwise, if the singleton already exists, use it.

        $tool = self::$tools[$className];

        if ($tool !== NULL) {

            return $tool;
        }

        // If the singleton doesn't exist, create, store, and use it.

        return self::$tools[$className] = new $className;
    }

    /**
     * Returns all tools, creating a singleton of them in the process if they haven't already been created.
     *
     * @return array
     */
    public static function getAllTools(): array
    {
        $buffer = [];

        foreach (self::$tools as $className => $tool) {

            if ($tool === NULL) {

                $buffer[] = self::getTool($className);
            } else {

                $buffer[] = $tool;
            }
        }

        return $buffer;
    }
}
