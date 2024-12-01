<?php namespace App\Services\ApiV1\Http\Requests;

use App\Domains\Http\StandardizedJsonResponse;
use App\Services\SourceBlock\Http\Requests\AbstractSourceBlockRequest;
use App\Services\SourceBlock\Http\Requests\Rules\StandardRules;
use App\Services\SourceBlock\Http\Requests\Rules\StringOrArray;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

/**
 * Validation of all requests for evaluation tools.
 *
 * @package App\Services\ApiV1\Http\Requests
 */
class EvaluationRequest extends AbstractSourceBlockRequest
{
    public function rules()
    {
        return array_merge([
            'structure' => ['required', new StringOrArray('The structure field must be a string, an array containing strings, or an object containing strings.')],
            'structure.*' => 'string',
        ], StandardRules::Options([
            'feedback' => 'boolean',
            'debug' => 'boolean',
            'statistics' => 'boolean',
            'components' => 'boolean'
        ]), StandardRules::GameOptions());
    }

    /**
     * @inheritDoc
     */
    protected function failureJsonResponse(Validator $validator)
    {
        throw new HttpResponseException(StandardizedJsonResponse::make(null, 400, $validator->errors()->toArray()));
    }

    /**
     * @inheritDoc
     */
    protected function failureHtmlResponse(Validator $validator)
    {
        abort(400, $validator->errors()->toJson());
    }

    public function messages()
    {
        return array_merge([ // TODO: localization
            'structure.*.string' => 'The input must be a string. Ensure you are sending the structure in a stringified format.',
        ], StandardRules::OptionsErrors('feedback', 'debug', 'statistics', 'components'), StandardRules::GameOptionsErrors());
    }
}
