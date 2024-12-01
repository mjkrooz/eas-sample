<?php namespace App\Services\ApiV1\Http\Middleware;

use Illuminate\Http\Request;
use App\Domains\Http\StandardizedJsonResponse;
use Closure;
use Seld\JsonLint\JsonParser;

/**
 * General API middleware that enforces a strict request:
 *
 *      Content-Type MUST be application/json
 *      Request body MUST be well-formed JSON
 *
 * Failure to comply results in a standardized JSON error response with a status code of 400.
 *
 * @package App\Services\ApiV1\Http\Middleware
 */
class EnsureRequestIsJson
{
    public function handle(Request $request, Closure $next)
    {
        // Content header must be JSON.

        if ($request->getContentType() !== 'json') {

            abort(StandardizedJsonResponse::make(null, 400, ['Request header must be "application/json".']));
        }

        // Body must be well-formed JSON.

        $issues = (new JsonParser())->lint($request->getContent());

        if ($issues !== null) {

            abort(StandardizedJsonResponse::make(null, 400, ['Request body must be well-formed JSON.', $issues->getMessage()]));
        }

        return $next($request);
    }
}
