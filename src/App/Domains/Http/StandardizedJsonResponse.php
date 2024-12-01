<?php namespace App\Domains\Http;

use Illuminate\Http\JsonResponse;

/**
 * All instances of JSON-returning API calls should use this class to build a standardized JSON response.
 *
 * @package App\Domains\Http
 */
final class StandardizedJsonResponse
{
    public static function make($content = null, int $status = 200, array $errors = [], array $headers = [], int $options = 0): JsonResponse
    {
        // Start with the status.

        $response = [
            'status' => $status
        ];

        // Add content if any. TODO: should empty data be allowed?

        if ($content !== null) {

            $response['data'] = $content;
        }

        // Add errors if any.

        $response['errors'] = $errors;

        // Return with the JSON response.

        return response()->json($response, $status, $headers, $options);
    }
}
