<?php

namespace App\Services\Tools\Features;

use App\Domains\Http\Jobs\RespondWithJsonAndErrorsJob;
use App\Domains\Minecraft\Tools\ToolInterface;
use App\Domains\Minecraft\Tools\Tools\Other\EvaluateTextComponents;
use App\Domains\Tools\Jobs\GetToolJob;
use App\Domains\Tools\Jobs\PopulateEventHandlerJob;
use App\Domains\Tools\Jobs\RunToolJob;
use App\Services\ApiV1\Http\Requests\EvaluationRequest;
use Lucid\Units\Feature;

class ViewEvaluatedTextComponentsFeature extends Feature
{
    public function handle(EvaluationRequest $request)
    {
        // Load the tool.

        /**
         * @var ToolInterface $tool
         */
        $tool = $this->run(GetToolJob::class, [
            'className' => EvaluateTextComponents::class,
            'inputs' => []
        ]);

        // Create the supervisor directly from the tool.

        $supervisor = $tool::buildSupervisor($request);

        // Populate the event handler.

        $this->run(PopulateEventHandlerJob::class, [
            'supervisor' => $supervisor
        ]);

        // Run the tool.

        $evaluations = $this->run(RunToolJob::class, [
            'tool' => $tool,
            'supervisor' => $supervisor
        ]);

        // Return the evaluations. If HTML is explicitly expected (true for browsers), return a view.

        if (!$request->acceptsAnyContentType() && $request->acceptsHtml()) {

            return view("tools::pages/evaluators/text_component", [
                'evaluations' => $evaluations,
                'raw' => $request->validated()['structure'] ?? [],
                'options' => $supervisor->getOptions()
            ]);
        }

        // Otherwise, return a JSON response as per API.

        return $this->run(RespondWithJsonAndErrorsJob::class, [
            'content' => ['evaluations' => $evaluations]
        ]);
    }
}
