<?php namespace App\Services\SourceBlock\Http\Requests\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Custom rules should extend this to gain the benefit of custom error messages.
 */
abstract class AbstractCustomRules implements Rule
{
    /**
     * @var string|null The custom error message.
     */
    private ?string $error;

    public function __construct(string $error = null)
    {
        $this->error = $error;
    }

    /**
     * Returns the custom error message, which may be NULL if not present.
     *
     * @return string|null
     */
    public function getError(): ?string
    {
        return $this->error;
    }

    /**
     * @inheritDoc
     */
    final public function message()
    {
        return $this->error ?? $this->defaultMessage();
    }

    /**
     * The default message to display if a custom message was not supplied.
     *
     * @return string
     */
    abstract protected function defaultMessage(): string;
}
