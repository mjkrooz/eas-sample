<?php namespace App\Services\SourceBlock\Http\Requests\Rules;

/**
 * A rule for determining whether a value is a string or array.
 */
class StringOrArray extends AbstractCustomRules
{
    /**
     * @inheritDoc
     */
    public function passes($attribute, $value)
    {
        return is_string($value) || is_array($value);
    }

    /**
     * @inheritDoc
     */
    protected function defaultMessage(): string
    {
        return 'The value of :attribute must either be a string or an array.';
    }
}
