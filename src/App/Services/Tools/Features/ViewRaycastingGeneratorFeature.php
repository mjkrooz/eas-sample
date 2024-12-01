<?php namespace App\Services\Tools\Features;

use App\Domains\Minecraft\Jobs\GetMinecraftFromRequestJob;
use App\Domains\Minecraft\Jobs\PopulateRegistriesJob;
use App\Domains\Minecraft\Jobs\RegisterStandardPopulatorsJob;
use App\Domains\Minecraft\Minecraft;
use App\Domains\Minecraft\Tools\Tools\DataPacks\RaycastingGenerator;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\Blocks;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\EntityTypes;
use Celestriode\DynamicRegistry\Exception\InvalidValue;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Lucid\Units\Feature;
use Ramsey\Uuid\Uuid;

class ViewRaycastingGeneratorFeature extends Feature
{
    /**
     * @throws InvalidValue
     */
    public function handle(Request $request): Factory|View|Application
    {
        // Get Minecraft request.

        $minecraft = $this->run(GetMinecraftFromRequestJob::class, [
            'edition' => Uuid::fromString(Minecraft::JAVA) // The generator only supports Java Edition.
        ]);

        // Register standard populators.

        $this->run(RegisterStandardPopulatorsJob::class, ['minecraft' => $minecraft]);

        // Populate registries to be used in the generator.

        $this->run(PopulateRegistriesJob::class, [
            'registries' => RaycastingGenerator::getRequiredRegistries($minecraft)
        ]);

        // Complete by returning view of the generator.

        return view("tools::pages/generators/raycasting", [
            'output' => [],
            'raw' => [],
            'entities' => EntityTypes::get()->getValues(),
            'blocks' => Blocks::get()->getValues()]
        );
    }
}
