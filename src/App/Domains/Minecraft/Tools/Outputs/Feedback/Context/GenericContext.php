<?php namespace App\Domains\Minecraft\Tools\Outputs\Feedback\Context;

use stdClass;

class GenericContext extends AbstractContext
{
    /**
     * @var string[] Context strings provided to this context.
     */
    protected array $values;

    public function __construct(string ...$values)
    {
        $this->values = $values;
    }

    /**
     * @inheritDoc
     */
    public function getContextType(): string
    {
        return 'generic';
    }

    /**
     * @inheritDoc
     */
    protected function toContextualOutput(): stdClass
    {
        $output = new stdClass();
        $output->values = $this->values;

        return $output;
    }
}
