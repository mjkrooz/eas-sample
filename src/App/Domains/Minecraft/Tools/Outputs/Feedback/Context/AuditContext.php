<?php namespace App\Domains\Minecraft\Tools\Outputs\Feedback\Context;

use Celestriode\Constructure\Context\AuditInterface;
use stdClass;

class AuditContext extends AbstractContext
{
    protected AuditInterface $audit;

    public function __construct(AuditInterface $audit)
    {
        $this->audit = $audit;
    }

    /**
     * @inheritDoc
     */
    public function getContextType(): string
    {
        return 'audit';
    }

    /**
     * @inheritDoc
     */
    protected function toContextualOutput(): stdClass
    {
        $output = new stdClass();
        $output->audit = $this->audit->toString();

        return $output;
    }

    /**
     * @inheritDoc
     */
    public function debugOnly(): bool
    {
        return true;
    }
}
