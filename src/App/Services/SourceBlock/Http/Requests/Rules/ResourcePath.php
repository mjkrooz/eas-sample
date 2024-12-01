<?php namespace App\Services\SourceBlock\Http\Requests\Rules;

/**
 * A rule for determining if a value represents a path to a subfolder.
 *
 * Custom rules are loaded in the service provider.
 */
class ResourcePath extends AbstractCustomRules
{
    /**
     * @inheritDoc
     */
    public function passes($attribute, $value)
    {
        return preg_match('/^(?:(?:(?:[a-z0-9-_][a-z0-9_\-\. ]*)|(?:\.[a-z0-9_\-\.]+))(?:\/(?!$)|$)?)+$/', $value);
    }

    /**
     * @inheritDoc
     */
    protected function defaultMessage(): string
    {
        return 'The value must be a proper resource location path, without a starting nor ending slash.';
    }
}
