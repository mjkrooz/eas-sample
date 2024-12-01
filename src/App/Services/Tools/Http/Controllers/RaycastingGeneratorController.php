<?php namespace App\Services\Tools\Http\Controllers;

use App\Services\Tools\Features\GenerateRaycastDataPackFeature;
use App\Services\Tools\Features\ViewRaycastingGeneratorFeature;
use Lucid\Units\Controller;

class RaycastingGeneratorController extends Controller
{
    public function viewGenerator()
    {
        return $this->serve(ViewRaycastingGeneratorFeature::class);
    }

    public function generate()
    {
        return $this->serve(GenerateRaycastDataPackFeature::class);
    }
}
