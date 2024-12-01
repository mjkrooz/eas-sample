<?php namespace App\Domains\Minecraft\Tools\Outputs\Feedback\Context;

use Celestriode\JsonConstructure\Structures\AbstractJsonStructure;
use Celestriode\JsonConstructure\Structures\Types\AbstractJsonPrimitive;
use Celestriode\JsonConstructure\Structures\Types\JsonObject;
use stdClass;

/**
 * A context for all JSON Constructure structures.
 *
 * @package App\Domains\Tools\Context
 */
class JsonContext extends AbstractStructuredContext
{
    /**
     * @var AbstractJsonStructure The JSON structure for this context.
     */
    protected AbstractJsonStructure $json;

    public function __construct(AbstractJsonStructure $json)
    {
        $this->json = $json;
    }

    /**
     * @inheritDoc
     */
    public function getContextType(): string
    {
        return 'json';
    }

    /**
     * @inheritDoc
     */
    protected function toContextualOutput(): stdClass
    {
        $output = new stdClass();
        $output->path = $this->json->toPath();

        return $output;
    }

    /**
     * Takes in a JSON structure and transforms it into an appropriate focused string.
     *
     * @param AbstractJsonStructure $json
     * @return string
     */
    protected function buildFocusedContext(AbstractJsonStructure $json): string
    {
        // If the JSON is primitive, and it is a field, the focus should be the whole field, not just the value.

        if ($json instanceof AbstractJsonPrimitive && $json->getKey() !== null && $json->getParent() !== null) {

            // Build up an input.

            $obj = new stdClass();
            $obj->{$json->getKey()} = $json->getValue();

            // Convert it to a JsonConstructure JsonObject.

            $newJson = new JsonObject($obj);

            // Reduce it to a string and trim off the ends.

            return mb_substr($newJson->toString(), 1, -1);
        }

        // Otherwise, return the original JSON stringified.

        return $json->toString();
    }
}
