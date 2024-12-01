<?php namespace App\Services\SourceBlock\Http\Requests\Rules;

class Boolean extends AbstractCustomRules
{
    /**
     * @inheritDoc
     */
    protected function defaultMessage(): string
    {
        return 'The value must be a boolean.';
    }

    /**
     * @inheritDoc
     */
    public function passes($attribute, $value)
    {
        return $value === 'on' || $value === true || $value === false || $value === 'true' || $value === 'false' || $value === 1 || $value === 0 || $value === '1' || $value === '0';
    }

    /**
     * Takes in an input and returns true or false based on it.
     *
     * @param mixed $input The input to normalize.
     * @return bool
     */
    public static function normalize(mixed $input): bool
    {
        // If the input can already be determined, return it as a bool.

        if (is_bool($input) || is_int($input)) {

            return (bool)$input;
        }

        // Otherwise, determine based on its value.

        return match ($input) {
            'true', '1', 'on' => true,
            default => false,
        };
    }
}
