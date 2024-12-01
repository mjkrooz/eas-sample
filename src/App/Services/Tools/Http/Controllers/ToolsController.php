<?php

namespace App\Services\Tools\Http\Controllers;

use App\Services\Tools\Features\ViewTextComponentEvaluatorFeature;
use App\Services\Tools\Features\ViewAllToolsFeature;
use Lucid\Units\Controller;

class ToolsController extends Controller
{
    public function home()
    {
        return $this->serve(ViewAllToolsFeature::class);
    }
}
