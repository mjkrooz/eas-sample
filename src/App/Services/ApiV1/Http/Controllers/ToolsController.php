<?php

namespace App\Services\ApiV1\Http\Controllers;

use App\Services\ApiV1\Features\ViewAllToolsFeature;
use App\Services\Tools\Features\GenerateRaycastDataPackFeature;
use App\Services\Tools\Features\ViewEvaluatedTargetSelectorsFeature;
use App\Services\Tools\Features\ViewEvaluatedTextComponentsFeature;
use Lucid\Units\Controller;

class ToolsController extends Controller
{
    public function home()
    {
        return $this->serve(ViewAllToolsFeature::class);
    }

    public function evaluateTextComponents()
    {
        return $this->serve(ViewEvaluatedTextComponentsFeature::class); // TODO: don't re-evaluate common input? Cache previous results?
    }

    public function evaluateTargetSelectors()
    {
        return $this->serve(ViewEvaluatedTargetSelectorsFeature::class);
    }

    public function generateRaycastDataPack()
    {
        return $this->serve(GenerateRaycastDataPackFeature::class);
    }

    /*public function evaluateAdvancements()
    {
        return $this->serve(EvaluateAdvancementsFeature::class);
    }*/

    /*public function evaluateAdvancementFile()
    {
        return $this->serve(EvaluateAdvancementFileFeature::class);
    }*/
}
