<?php

namespace App\Services\Tools\Http\Controllers;

use App\Services\Tools\Features\ViewEvaluatedTextComponentsFeature;
use App\Services\Tools\Features\ViewTextComponentEvaluatorFeature;
use Lucid\Units\Controller;

class TextComponentToolsController extends Controller
{
    public function viewEvaluator()
    {
        return $this->serve(ViewTextComponentEvaluatorFeature::class);
    }

    public function evaluate()
    {
        return $this->serve(ViewEvaluatedTextComponentsFeature::class); // TODO: array of Evaluation objects.
    }
}
