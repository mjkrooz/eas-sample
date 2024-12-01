<?php namespace App\Domains\Minecraft\Tools\Outputs\Feedback\Context;

use stdClass;

class ResourceLocationContext extends AbstractContext
{
    /**
     * @inheritDoc
     */
    public function getContextType(): string
    {
        return 'uses_resource_location';
    }

    /**
     * @inheritDoc
     */
    protected function toContextualOutput(): stdClass
    {
        return new stdClass();
    }
}
