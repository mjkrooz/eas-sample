<?php

namespace App\Domains\Http\Jobs;

use Lucid\Units\Job;

/**
 * A general-purpose content-type checker
 *
 * @package App\Domains\Http\Jobs
 */
abstract class AbstractValidateRequestJob extends Job
{
    protected ?string $contentType;
    protected ?string $content;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(?string $contentType, ?string $content)
    {
        $this->contentType = $contentType;
        $this->content = $content;
    }
}
