<?php

namespace App\Domains\Http\Jobs;

use App\Domains\Http\StandardizedJsonResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\ResponseFactory;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;
use Lucid\Units\Job;

class RespondWithJsonAndErrorsJob extends RespondWithJsonJob
{
    private $errors = [];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($content, $status = 200, array $headers = [], $options = 0, array $errors = [])
    {
        parent::__construct($content, $status, $headers, $options);

        $this->errors = $errors;
    }

    /**
     * Execute the job.
     *
     * @param ResponseFactory $factory
     * @return JsonResponse
     */
    public function handle(ResponseFactory $factory): JsonResponse
    {
        return StandardizedJsonResponse::make($this->content, $this->status, $this->errors, $this->headers, $this->options);
    }
}
