<?php namespace App\Domains\Minecraft\Tools\Outputs\Feedback\Context;

use stdClass;

abstract class AbstractContext
{
    /**
     * Returns the user-friendly name of the context.
     *
     * @return string
     */
    abstract public function getContextType(): string;

    /**
     * Transforms the context into an API-appropriate output.
     *
     * @return stdClass
     */
    abstract protected function toContextualOutput(): stdClass;

    /**
     * Creates an API-appropriate output from the context.
     *
     * @return stdClass
     */
    final public function toOutput(): stdClass
    {
        $output = $this->toContextualOutput();
        $output->type = $this->getContextType();

        return $output;
    }

    /**
     * Returns whether the context should only be provided if the "debug" option is true in the API call.
     *
     * @return bool
     */
    public function debugOnly(): bool
    {
        return false;
    }
}
