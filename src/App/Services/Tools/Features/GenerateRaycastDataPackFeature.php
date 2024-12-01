<?php namespace App\Services\Tools\Features;

use App\Domains\Lectern\Lectern;
use App\Domains\Minecraft\Packs\DataPack;
use App\Domains\Minecraft\Tools\Tools\DataPacks\RaycastingGenerator;
use App\Domains\SourceBlock\Jobs\CreateZipArchiveJob;
use App\Domains\Tools\Jobs\GetToolJob;
use App\Domains\Tools\Jobs\RunToolJob;
use App\Services\ApiV1\Http\Requests\GenerateRaycastDataPackRequest;
use Lucid\Units\Feature;
use ZipStream\Exception\OverflowException;

class GenerateRaycastDataPackFeature extends Feature
{
    /**
     * @throws OverflowException
     */
    public function handle(GenerateRaycastDataPackRequest $request)
    {
        // Create the zip archive that the tool will use.

        $zip = $this->run(CreateZipArchiveJob::class, [
            'filename' => RaycastingGenerator::ARCHIVE_NAME,
            'archive' => null // TODO: this is sad.
        ]);

        // Get the raycasting generator.

        /**
         * @var RaycastingGenerator $tool
         */
        $tool = $this->run(GetToolJob::class, [
            'className' => RaycastingGenerator::class,
            'inputs' => [DataPack::make(RaycastingGenerator::ARCHIVE_NAME)] // TODO: job.
        ]);

        // Create a supervisor from the generator.

        $supervisor = $tool::buildSupervisor($request);

        // Run the tool. TODO: do I even need to use the event handler?

        $this->run(RunToolJob::class, [
            'tool' => $tool,
            'supervisor' => $supervisor
        ]);

        // Output the data pack archive. TODO: turn this into a job.

        // If the format was for the Lectern source, get and return that. TODO: clean this up.

        if ($request->input('format') === 'lectern') {

            $lectern = new Lectern();
            $lectern->setDataPack($tool->getDataPack());

            echo $lectern->toSource(true);
        } else {

            $zip = $tool->getDataPack()->zip();

            $zip->finish();
        }

        exit();
    }
}
