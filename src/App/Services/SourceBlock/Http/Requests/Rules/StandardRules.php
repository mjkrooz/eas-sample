<?php namespace App\Services\SourceBlock\Http\Requests\Rules;

use Illuminate\Contracts\Validation\Rule;

final class StandardRules
{
    public static function Options(array $fields): array
    {
        $options = [];
        $root = 'filled|array:';
        $i = 0;
        $j = count($fields);

        foreach ($fields as $name => $rules) {

            // Cancel if the input was malformed.

            if (!is_string($name) || (!is_array($rules) && !is_string($rules) && !is_subclass_of($rules, Rule::class))) {

                throw new \BadMethodCallException('Each input must be an associative array where the values are either a string or an array of strings');
            }

            // Set rules to the option.

            $options['options.' . $name] = $rules;

            // Append option name to root option.

            $root .= $name;

            if ($i + 1 != $j) {

                $root .= ',';
            }

            $i++;
        }

        $options['options'] = $root;

        return $options;
    }

    public static function OptionsErrors(string ...$fields): array
    {
        return [
            'options.array' => 'the options field must be an object with the following fields: ' . implode(', ', $fields)
        ];
    }

    /**
     * Rules for defining the Minecraft edition and version and other relevant information.
     *
     * @return string[]
     */
    public static function GameOptions(): array
    {
        return [
            'options.game' => 'array:edition,version',
            'options.game.edition' => 'prohibits:options.game.version|uuid',
            'options.game.version' => 'prohibits:options.game.edition|uuid'
        ];
    }

    /**
     * Errors for when there is invalid input for the standard rules for game options.
     *
     * @return string[]
     */
    public static function GameOptionsErrors(): array
    {
        return [
            'options.game.array' => 'the options.game field must be an object with only the following fields: edition, version',
            'options.game.edition.prohibits' => 'Cannot specify both :attribute and :other together.',
            'options.game.version.prohibits' => 'Cannot specify both :attribute and :other together.',
        ];
    }
}
