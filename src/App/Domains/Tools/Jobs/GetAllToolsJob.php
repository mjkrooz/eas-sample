<?php

namespace App\Domains\Tools\Jobs;

use App\Domains\Minecraft\Tools\ToolInterface;
use Lucid\Units\Job;

class GetAllToolsJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return ToolInterface[]
     */
    public function handle(): array
    {
        return [];
    }
}
