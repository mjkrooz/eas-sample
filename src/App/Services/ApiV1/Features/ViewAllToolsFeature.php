<?php

namespace App\Services\ApiV1\Features;

use App\Domains\Http\Jobs\RespondWithJsonAndErrorsJob;
use App\Domains\Tools\Jobs\GetAllToolsJob;
use Illuminate\Http\Request;
use Lucid\Units\Feature;

class ViewAllToolsFeature extends Feature
{
    public function handle(Request $request)
    {
        $tools = $this->run(GetAllToolsJob::class);

        return $this->run(RespondWithJsonAndErrorsJob::class, ['content' => $tools]);
    }
}
