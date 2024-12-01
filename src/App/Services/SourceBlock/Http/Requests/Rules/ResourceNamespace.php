<?php namespace App\Services\SourceBlock\Http\Requests\Rules;

class ResourceNamespace extends AbstractCustomRules
{
    /**
     * @inheritDoc
     */
    public function passes($attribute, $value)
    {
        return preg_match('/^[a-z0-9_]+$/', $value);
    }

    /**
     * @inheritDoc
     */
    protected function defaultMessage(): string
    {
        return 'The value must be a proper resource location namespace.';
    }
}
