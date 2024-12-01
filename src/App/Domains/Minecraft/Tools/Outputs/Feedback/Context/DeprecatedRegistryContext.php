<?php namespace App\Domains\Minecraft\Tools\Outputs\Feedback\Context;

use App\Domains\Minecraft\Registries\Registries;
use Celestriode\DynamicRegistry\AbstractRegistry;
use stdClass;

class DeprecatedRegistryContext extends AbstractContext
{
    protected AbstractRegistry $registry;

    public function __construct(AbstractRegistry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * @inheritDoc
     */
    public function getContextType(): string
    {
        return 'deprecated_registry';
    }

    /**
     * @inheritDoc
     */
    protected function toContextualOutput(): stdClass
    {
        $output = new stdClass();
        $output->registry = Registries::getUuidFromRegistry($this->registry)->toString();

        return $output;
    }
}
