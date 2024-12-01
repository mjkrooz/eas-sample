<?php

namespace App\Domains\Http\Jobs\Request;

use App\Domains\Http\Jobs\AbstractValidateRequestJob;

class ValidateFormRequestJob extends AbstractValidateRequestJob
{
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Content header must be a form.

        if ($this->contentType !== 'form') {

            abort(400);
        }
    }
}
