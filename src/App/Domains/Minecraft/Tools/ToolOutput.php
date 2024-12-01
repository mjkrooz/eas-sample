<?php namespace App\Domains\Minecraft\Tools;

/**
 * Standardized class for tool outputs. All tools should theoretically have an output, but if one does not, simply don't
 * use this.
 */
class ToolOutput
{
    private mixed $output;

    public function __construct(mixed $output)
    {
        $this->output = $output;
    }

    /**
     * Returns the value of the output.
     *
     * @return mixed
     */
    public function getOutput(): mixed
    {
        return $this->output;
    }
}
