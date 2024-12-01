<?php namespace App\Domains\Minecraft\Tools\Outputs\Feedback\Context;

use Celestriode\Constructure\Structures\StructureInterface;
use stdClass;

/**
 * A general context for Constructure structures.
 *
 * @package App\Domains\Tools\Context
 */
class StructureContext extends AbstractStructuredContext
{
    /**
     * @var StructureInterface The context's structure.
     */
    protected StructureInterface $structure;

    public function __construct(StructureInterface $structure)
    {
        $this->structure = $structure;
    }

    /**
     * @inheritDoc
     */
    public function getContextType(): string
    {
        return 'structure';
    }

    /**
     * @inheritDoc
     */
    protected function toContextualOutput(): stdClass
    {
        $output = new stdClass();
        $output->structure = $this->structure->toString();

        return $output;
    }
}
