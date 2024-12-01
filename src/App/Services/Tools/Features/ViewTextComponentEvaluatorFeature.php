<?php

namespace App\Services\Tools\Features;

use Illuminate\Http\Request;
use Lucid\Units\Feature;

class ViewTextComponentEvaluatorFeature extends Feature
{
    public function handle(Request $request)
    {
        return view("tools::pages/evaluators/text_component", ['evaluations' => [], 'raw' => []]);
    }
}
