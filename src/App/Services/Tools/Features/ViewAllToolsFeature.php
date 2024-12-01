<?php

namespace App\Services\Tools\Features;

use App\Domains\Tools\Jobs\GetAllToolsJob;
use Illuminate\Http\Request;
use Lucid\Units\Feature;

class ViewAllToolsFeature extends Feature
{
    public function handle(Request $request)
    {
        $tools = $this->run(GetAllToolsJob::class);

        return view("tools::pages/home", ['tools' => $tools]);
    }
}
