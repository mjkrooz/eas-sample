<?php namespace App\Domains\Minecraft\Tools;

/**
 * Standardized input class for all tools. Some tools have no input, in which case, just don't use this.
 */
class ToolInput
{
    private string $id;
    private mixed $input;

    public function __construct(string $id, mixed $input)
    {
        $this->id = $id;
        $this->input = $input;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getInput(): mixed
    {
        return $this->input;
    }
}
