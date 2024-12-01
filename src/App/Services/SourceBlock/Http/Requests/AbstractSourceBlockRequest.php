<?php namespace App\Services\SourceBlock\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Overarching request handler for Source Block. Primarily includes handling a variety of request types.
 *
 * @package App\Services\SourceBlock\Http\Requests
 */
abstract class AbstractSourceBlockRequest extends FormRequest
{
    /**
     * Handling validation failure in the form of a JSON response.
     *
     * @param Validator $validator
     * @return mixed
     */
    abstract protected function failureJsonResponse(Validator $validator);

    /**
     * Handling validation failure in the form of an HTML response.
     *
     * @param Validator $validator
     * @return mixed
     */
    abstract protected function failureHtmlResponse(Validator $validator);

    protected function failedValidation(Validator $validator)
    {
        // If using a browser directly, then return the HTML view.

        if (!$this->acceptsAnyContentType() && $this->acceptsHtml()) {

            $this->failureHtmlResponse($validator);
        } else {

            // Otherwise, return a JSON response.

            $this->failureJsonResponse($validator);
        }
    }
}
