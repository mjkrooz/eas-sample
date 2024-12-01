<?php namespace App\Domains\Minecraft\Tools\Outputs\Feedback;

use App\Domains\Minecraft\Tools\Outputs\Feedback\Context\AbstractContext;

class FeedbackMessage
{
    /**
     * @var string The simple message for the user.
     */
    private string $message;

    /**
     * @var AbstractContext[] The contexts to help the user pinpoint where the issue is.
     */
    private array $contexts;

    public function __construct(string $message, AbstractContext ...$contexts)
    {
        $this->message = $message;
        $this->contexts = $contexts;
    }

    /**
     * Returns the message itself.
     *
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Returns the context associated with this message.
     *
     * @return AbstractContext[]
     */
    public function getContexts(bool $includeDebug = false): array
    {
        if ($includeDebug) {

            return $this->contexts;
        }

        // array_values because array_filter may return elements such as [0] and [2] but not [1], which can cause issues
        // when converting to JSON output. TODO: move array_values to the job?

        return array_values(array_filter($this->contexts, function (AbstractContext $context) {

            return !$context->debugOnly();
        }));
    }
}
