<?php namespace App\Services\ApiV1\Http\Requests;

use App\Domains\Http\StandardizedJsonResponse;
use App\Domains\Minecraft\Tools\Tools\DataPacks\RaycastingGenerator;
use App\Services\SourceBlock\Http\Requests\AbstractSourceBlockRequest;
use App\Services\SourceBlock\Http\Requests\Rules\Boolean;
use App\Services\SourceBlock\Http\Requests\Rules\ResourceNamespace;
use App\Services\SourceBlock\Http\Requests\Rules\StandardRules;
use App\Services\SourceBlock\Http\Requests\Rules\ResourcePath;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class GenerateRaycastDataPackRequest extends AbstractSourceBlockRequest
{
    public function rules()
    {
        return array_merge([
            'format' => 'string|in:lectern,zip',
            'detection' => 'filled|array',
            'detection.method' => 'required|string|in:' . implode(',', RaycastingGenerator::getMethodTypes()),
            'detection.max_distance' => 'integer|min:1',
            'detection.step_distance' => 'numeric|gt:0|max:1000',
            'detection.units' => 'in:steps,blocks',
            'detection.entity.entities' => 'array',
            'detection.block.blocks' => 'required_if:detection.method,block|required_if:detection.method,both|array',
            'detection.block.inverted' => new Boolean(),
        ], StandardRules::Options([
            RaycastingGenerator::OPTION_NAMESPACE => ['string', 'min:1', new ResourceNamespace()],
            RaycastingGenerator::OPTION_SUBFOLDER => ['string', 'min:1', new ResourcePath()],
            RaycastingGenerator::OPTION_OBJECTIVE => ['string',  'min:1'],
            RaycastingGenerator::OPTION_CREATE_OBJECTIVE => new Boolean(),
            RaycastingGenerator::OPTION_TAG => ['string', 'min:0']
        ]), StandardRules::GameOptions(), $this->commandRules());
    }

    /**
     * Generates rules for all the command sections that the generator will use.
     *
     * @return string[]
     */
    protected function commandRules(): array
    {
        $commands = RaycastingGenerator::getCommandSectionNames();
        $rules = [
            'commands' => 'filled|array:' . implode(',', $commands)
        ];

        foreach ($commands as $command) {

            $rules['commands.' . $command] = 'required_without_all:commands.' . implode(',commands.', array_diff($commands, [$command])) . '|string';
        }

        return $rules;
    }

    /**
     * @inheritDoc
     */
    protected function failureJsonResponse(Validator $validator)
    {
        throw new HttpResponseException(StandardizedJsonResponse::make(null, 400, $validator->errors()->toArray()));
    }

    /**
     * @inheritDoc
     */
    protected function failureHtmlResponse(Validator $validator)
    {
        abort(400, $validator->errors()->toJson());
    }

    public function messages()
    {
        return array_merge([ // TODO: localization
            'format.in' => 'The format must either be "zip" or "lectern"',
            'detection.array' => 'A detection method must be included',
            'detection.method.in' => 'The detection method must be one of: ' . implode(', ', RaycastingGenerator::getMethodTypes()),
            'commands.*.required_without_all' => 'At least 1 command section must contain commands.',
            'detection.block.blocks.required_if' => 'At least 1 block must be specified.',
            'detection.max_distance.min' => 'The maximum distance must be at least :min.',
            'detection.step_distance.gt' => 'The step distance must be greater than 0.',
            'detection.step_distance.max' => 'The step distance must not be greater than :max.',
            'detection.units.in' => 'The units must either be "blocks" or "steps".'
        ], StandardRules::GameOptionsErrors());
    }
}
