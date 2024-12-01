<?php namespace App\Domains\Minecraft\Tools;

use RuntimeException;

/**
 * A general holding of options to be used with tools.
 */
class ToolOptions
{
    public const FEEDBACK = 'feedback';
    public const STATISTICS = 'statistics';
    public const COMPONENTS = 'components';
    public const DEBUG = 'debug';
    public const GAME = 'game';

    public const FEEDBACK_DEFAULT = true;
    public const STATISTICS_DEFAULT = false;
    public const COMPONENTS_DEFAULT = false;
    public const DEBUG_DEFAULT = false;
    public const GAME_EDITION_DEFAULT = '00000000-0000-0000-0000-000000000000';
    public const GAME_VERSION_DEFAULT = '00000000-0000-0000-0000-000000000000';

    /**
     * @var array The list of options for the tool to use.
     */
    protected array $options = [];

    /**
     * Sets a single option and value.
     *
     * @param string $name The name of the option.
     * @param mixed $value The value of the option, which can be any type.
     * @return $this
     */
    public function setOption(string $name, mixed $value): self
    {
        $this->options[$name] = $value;

        return $this;
    }

    /**
     * Returns an option's value if it exists. Throws a RuntimeException if it does not exist.
     *
     * @param string $name The name of the option to get the value of.
     * @return mixed
     */
    public function getOption(string $name): mixed
    {
        if (!array_key_exists($name, $this->options)) {

            throw new RuntimeException('Option "' . $name . '" does not exist.');
        }

        return $this->options[$name];
    }
}
