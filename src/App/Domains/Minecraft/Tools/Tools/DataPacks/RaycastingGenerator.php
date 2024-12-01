<?php namespace App\Domains\Minecraft\Tools\Tools\DataPacks;

use App\Domains\Minecraft\Minecraft;
use App\Domains\Minecraft\Packs\DataPack;
use App\Domains\Minecraft\Packs\PackMCMeta;
use App\Domains\Minecraft\Tools\ToolInput;
use App\Domains\Minecraft\Tools\ToolInputs;
use App\Domains\Minecraft\Tools\ToolInterface;
use App\Domains\Minecraft\Tools\ToolOptions;
use App\Domains\Minecraft\Tools\Tools\AbstractOtherTool;
use App\Domains\Minecraft\Tools\ToolSupervisor;
use App\Services\SourceBlock\Http\Requests\Rules\Boolean;
use Celestriode\ConstructuresMinecraft\Utils\ResourceLocation;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\Blocks;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\EntityTypes;
use Celestriode\Mattock\Parsers\Java\Utils\ResourceLocation as ResourceLocationAlias;
use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;

class RaycastingGenerator extends AbstractOtherTool
{
    public const OPTION_NAMESPACE = 'namespace';
    public const OPTION_SUBFOLDER = 'subfolder';
    public const OPTION_OBJECTIVE = 'objective';
    public const OPTION_CREATE_OBJECTIVE = 'create_objective';
    public const OPTION_TAG = 'tag';

    public const METHOD_ENTITY = 'entity';
    public const METHOD_BLOCK = 'block';
    public const METHOD_BOTH = 'both';

    public const METHOD_MAX_DISTANCE = 'max_distance';
    public const METHOD_STEP_DISTANCE = 'step_distance';
    public const METHOD_UNITS = 'units';
    public const METHOD_ENTITIES = 'entities';
    public const METHOD_BLOCKS = 'blocks';
    public const METHOD_BLOCKS_INVERTED = 'blocks_inverted';

    public const COMMAND_ENTITY_FOUND = 'entity_found';
    public const COMMAND_BLOCK_FOUND = 'block_found';
    public const COMMAND_PRE_RAYCAST = 'pre_raycast';
    public const COMMAND_POST_RAYCAST = 'post_raycast';
    public const COMMAND_STEP = 'step';
    public const COMMAND_FAILED = 'failed';

    public const MAX_DISTANCE_DEFAULT = 10;
    public const STEP_DISTANCE_DEFAULT = 0.1;
    public const UNITS_DEFAULT = 'blocks';

    public const ARCHIVE_NAME = 'raycast_data_pack';

    /**
     * @var DataPack The zip archive within which to create a data pack.
     */
    protected DataPack $dataPack;

    private bool $addComments;

    public function __construct(DataPack $dataPack, bool $addComments = true)
    {
        $this->dataPack = $dataPack;
        $this->addComments = $addComments;
    }

    /**
     * Returns the zip archive that this tool used.
     *
     * @return DataPack
     */
    public function getDataPack(): DataPack
    {
        return $this->dataPack;
    }

    /**
     * Returns the names of the types of methods, which can be used for the field names of the form and API.
     *
     * @return string[]
     */
    public static function getMethodTypes(): array
    {
        return [self::METHOD_ENTITY, self::METHOD_BLOCK, self::METHOD_BOTH];
    }

    /**
     * Returns the names of the command sections, which can be used for the field names of the form and API.
     *
     * @return string[]
     */
    public static function getCommandSectionNames(): array
    {
        return [self::COMMAND_ENTITY_FOUND, self::COMMAND_BLOCK_FOUND, self::COMMAND_PRE_RAYCAST, self::COMMAND_POST_RAYCAST, self::COMMAND_STEP, self::COMMAND_FAILED];
    }

    /**
     * @inheritDoc
     */
    public function runTool(ToolSupervisor $supervisor): void
    {
        // Add pack.mcmeta

        $this->addPackMCMeta($supervisor);

        // Add ray start.

        $this->addRayStart($supervisor);

        // Add objective autoload.

        if ($supervisor->getOptions()->getOption(self::OPTION_CREATE_OBJECTIVE)) {

            $this->addObjectiveAutoload($supervisor);
        }
    }

    protected function addPackMCMeta(ToolSupervisor $supervisor): void
    {
        $MCMeta = new PackMCMeta("Generated from https://sourceblock.net, based on vdvman1's raycasting template.");

        $this->getDataPack()->setPackMcMeta($MCMeta);
    }

    protected function getMaxDistance(ToolSupervisor $supervisor): int
    {
        $maxDistanceInput = (int)$supervisor->getInputs()[self::METHOD_MAX_DISTANCE]->getInput();
        $stepDistance = $this->getStepDistance($supervisor);

        if ($supervisor->getInputs()[self::METHOD_UNITS]->getInput() === 'blocks') {

            return (int)ceil($maxDistanceInput / (($stepDistance > 0) ? $stepDistance : self::STEP_DISTANCE_DEFAULT));
        }

        return $maxDistanceInput;
    }

    protected function getStepDistance(ToolSupervisor $supervisor): float
    {
        return (float)$supervisor->getInputs()[self::METHOD_STEP_DISTANCE]->getInput();
    }

    protected function addRayStart(ToolSupervisor $supervisor): void
    {
        $options = $supervisor->getOptions();
        $namespace = $options->getOption(self::OPTION_NAMESPACE);
        $subfolder = $options->getOption(self::OPTION_SUBFOLDER);
        $tag = $options->getOption(self::OPTION_TAG);
        $objective = $options->getOption(self::OPTION_OBJECTIVE);
        $maxDistance = $this->getMaxDistance($supervisor);

        // Begin building the function.

        $function = new DataPack\MCFunction(new ResourceLocation($namespace, $subfolder . 'start_ray'));

        $this->addComment($function, 'Setting up the raycasting data.');
        $function->addCommands(
            "tag @s add {$tag}",
            "scoreboard players set #hit {$objective} 0",
            "scoreboard players set #distance {$objective} 0"
        );

        // Add pre-raycast commands.

        $preRaycast = $this->getNormalizedCommands($supervisor, self::COMMAND_PRE_RAYCAST);

        if (!empty($preRaycast)) {

            $this->addComment($function, 'Running custom pre-raycast commands.');
            $function->addCommands(...$preRaycast);
        }

        // The ray itself.

        $this->addComment($function, 'Activating the raycast. This function will call itself until it is done.');
        $function->addCommand("function {$namespace}:{$subfolder}ray");

        $this->addRayStep($supervisor);

        // Add post-raycast commands.

        $postRaycast = $this->getNormalizedCommands($supervisor, self::COMMAND_POST_RAYCAST);

        if (!empty($postRaycast)) {

            $this->addComment($function, 'Running custom post-raycast commands.');
            $function->addCommands(...$postRaycast);
        }

        // Ray finished.

        $this->addComment($function, 'Raycasting finished, removing tag from the raycaster.');
        $function->addCommand("tag @s remove {$tag}");

        // Add the function to the data pack.

        $this->getDataPack()->addFunction($function);
    }

    protected function addRayStep(ToolSupervisor $supervisor): void
    {
        $options = $supervisor->getOptions();
        $namespace = $options->getOption(self::OPTION_NAMESPACE);
        $subfolder = $options->getOption(self::OPTION_SUBFOLDER);
        $method = $options->getOption('method');
        $objective = $options->getOption(self::OPTION_OBJECTIVE);
        $maxDistance = $this->getMaxDistance($supervisor);
        $stepDistance = $this->getStepDistance($supervisor);
        $tag = $options->getOption(self::OPTION_TAG);

        $function = new DataPack\MCFunction(new ResourceLocation($namespace, $subfolder . 'ray'));

        // Commands per step of the ray.

        $stepCommands = $this->getNormalizedCommands($supervisor, self::COMMAND_STEP);

        if (!empty($stepCommands)) {

            $this->addComment($function, 'Running custom per-step commands.');
            $function->addCommands(...$stepCommands);
        }

        // Add hit entity.

        if ($method === self::METHOD_ENTITY || $method === self::METHOD_BOTH) {

            // Add command to the step to activate the function to check if an entity was hit.

            $this->addComment($function, 'Check if an entity was detected.');

            if (empty($supervisor->getInputs()[self::METHOD_ENTITIES]->getInput())) {

                $function->addCommand("execute if score #hit {$objective} matches 0 positioned ~-0.05 ~-0.05 ~-0.05 as @e[tag=!{$tag},dx=0,sort=nearest] run function {$namespace}:{$subfolder}check_hit_entity");
            } else {

                $function->addCommand("execute if score #hit {$objective} matches 0 positioned ~-0.05 ~-0.05 ~-0.05 as @e[type=#{$namespace}:{$subfolder}entities,tag=!{$tag},dx=0,sort=nearest] run function {$namespace}:{$subfolder}check_hit_entity");

                // Add the entity tag.

                $this->addEntitiesTag($supervisor);
            }

            // Add the check hit entity function.

            $this->addCheckHitEntity($supervisor);
        }

        // Add hit block.

        if ($method === self::METHOD_BLOCK || $method === self::METHOD_BOTH) {

            $inverted = $supervisor->getInputs()[self::METHOD_BLOCKS_INVERTED]->getInput();

            $this->addComment($function, 'Run a function if a block was successfully detected.');
            $function->addCommand("execute " . (!$inverted ? 'if' : 'unless') . " block ~ ~ ~ #{$namespace}:{$subfolder}blocks run function {$namespace}:{$subfolder}hit_block");

            $this->addBlocksTag($supervisor);
            $this->addHitBlock($supervisor);
        }

        $function->addCommand("scoreboard players add #distance {$objective} 1");

        // Commands for failure.

        if ($supervisor->getInputs()[self::COMMAND_FAILED]->getInput() !== '') {

            $this->addComment($function, 'If the raycast failed, run a function with the custom commands.');
            $function->addCommand("execute if score #hit {$objective} matches 0 if score #distance {$objective} matches " . ($maxDistance + 1) . ".. run function {$namespace}:{$subfolder}failed");

            $this->addRayFailed($supervisor);
        }

        // Ray finished.

        $this->addComment($function, 'Advance forward and run the ray again if no entity and/or block was found.');
        $function->addCommand(
            "execute if score #hit {$objective} matches 0 if score #distance {$objective} matches .." . $maxDistance . " positioned ^ ^ ^{$stepDistance} run function {$namespace}:{$subfolder}ray"
        );

        // Add the function to the stream.

        $this->getDataPack()->addFunction($function);
    }

    protected function addHitEntity(ToolSupervisor $supervisor): void
    {
        $options = $supervisor->getOptions();
        $namespace = $options->getOption(self::OPTION_NAMESPACE);
        $subfolder = $options->getOption(self::OPTION_SUBFOLDER);
        $objective = $options->getOption(self::OPTION_OBJECTIVE);

        // Add entity hit function to archive using the custom commands provided.

        $function = new DataPack\MCFunction(new ResourceLocation($namespace, $subfolder . 'hit_entity'));

        $this->addComment($function, 'Mark the ray has having found an entity.');
        $function->addCommand("scoreboard players set #hit {$objective} 1");

        $commands = $this->getNormalizedCommands($supervisor, self::COMMAND_ENTITY_FOUND);

        if (!empty($commands)) {

            $this->addComment($function, 'Running custom commands since the entity was found.');
            $function->addCommands(...$commands);
        }

        $this->getDataPack()->addFunction($function);
    }

    protected function addCheckHitEntity(ToolSupervisor $supervisor): void
    {
        $options = $supervisor->getOptions();
        $namespace = $options->getOption(self::OPTION_NAMESPACE);
        $subfolder = $options->getOption(self::OPTION_SUBFOLDER);
        $objective = $options->getOption(self::OPTION_OBJECTIVE);

        $this->addHitEntity($supervisor);

        $function = new DataPack\MCFunction(new ResourceLocation($namespace, $subfolder . 'check_hit_entity'));

        $this->addComment($function, 'Checks if an entity is found, and if so, runs the corresponding function.');
        $function->addCommand("execute if score #hit {$objective} matches 0 positioned ~-0.9 ~-0.9 ~-0.9 if entity @s[dx=0] positioned ~0.95 ~0.95 ~0.95 run function {$namespace}:{$subfolder}hit_entity");

        $this->getDataPack()->addFunction($function);
    }

    protected function addHitBlock(ToolSupervisor $supervisor): void
    {
        $options = $supervisor->getOptions();
        $namespace = $options->getOption(self::OPTION_NAMESPACE);
        $subfolder = $options->getOption(self::OPTION_SUBFOLDER);
        $objective = $options->getOption(self::OPTION_OBJECTIVE);

        // Add block hit function to archive using the custom commands provided.

        $function = new DataPack\MCFunction(new ResourceLocation($namespace, $subfolder . 'hit_block'));

        $this->addComment($function, 'Mark the ray as having found a block.');
        $function->addCommand("scoreboard players set #hit {$objective} 1");

        $commands = $this->getNormalizedCommands($supervisor, self::COMMAND_BLOCK_FOUND);

        if (!empty($commands)) {

            $this->addComment($function, 'Running custom commands since the block was found.');
            $function->addCommands(...$commands);
        }

        $this->getDataPack()->addFunction($function);
    }

    protected function addRayFailed(ToolSupervisor $supervisor): void
    {
        $options = $supervisor->getOptions();
        $namespace = $options->getOption(self::OPTION_NAMESPACE);
        $subfolder = $options->getOption(self::OPTION_SUBFOLDER);
        $failed = $this->getNormalizedCommands($supervisor, self::COMMAND_FAILED);

        $function = new DataPack\MCFunction(new ResourceLocation($namespace, $subfolder . 'failed'));
        $this->addComment($function, 'Commands to run when the raycast has failed to detect an entity and/or block.');
        $function->addCommands(...$failed);

        $this->getDataPack()->addFunction($function);
    }

    protected function addEntitiesTag(ToolSupervisor $supervisor): void
    {
        $options = $supervisor->getOptions();
        $namespace = $options->getOption(self::OPTION_NAMESPACE);
        $subfolder = $options->getOption(self::OPTION_SUBFOLDER);
        $entities = $supervisor->getInputs()[self::METHOD_ENTITIES]->getInput();

        // Create entity tag.

        $tag = new DataPack\Tag(new ResourceLocation($namespace, $subfolder . 'entities'), DataPack\Tag::TAG_ENTITY_TYPES);
        $tag->addValues(...$entities);

        $this->getDataPack()->addTag($tag);
    }

    protected function addBlocksTag(ToolSupervisor $supervisor): void
    {
        $options = $supervisor->getOptions();
        $namespace = $options->getOption(self::OPTION_NAMESPACE);
        $subfolder = $options->getOption(self::OPTION_SUBFOLDER);
        $blocks = $supervisor->getInputs()[self::METHOD_BLOCKS]->getInput();

        // Create block tag.

        $tag = new DataPack\Tag(new ResourceLocation($namespace, $subfolder . 'blocks'), DataPack\Tag::TAG_BLOCKS);
        $tag->addValues(...$blocks);

        // Add block tag to archive.

        $this->getDataPack()->addTag($tag);
    }

    protected function addObjectiveAutoload(ToolSupervisor $supervisor): void
    {
        $options = $supervisor->getOptions();
        $namespace = $options->getOption(self::OPTION_NAMESPACE);
        $subfolder = $options->getOption(self::OPTION_SUBFOLDER);
        $objective = $options->getOption(self::OPTION_OBJECTIVE);

        $tag = new DataPack\Tag(new ResourceLocation(ResourceLocationAlias::NAMESPACE, 'load'), DataPack\Tag::TAG_FUNCTIONS);
        $function = new DataPack\MCFunction(new ResourceLocation($namespace, $subfolder . 'load'));

        $tag->addValue($function->getResourceLocation()->toString());
        $function->addCommand("scoreboard objectives add {$objective} dummy");

        $this->getDataPack()->addTag($tag);
        $this->getDataPack()->addFunction($function);
    }

    protected function addComment(DataPack\MCFunction $function, string $comment): void
    {
        if (!$this->addComments) {

            return;
        }

        $function->addComment($comment);
    }

    protected function getNormalizedCommands(ToolSupervisor $supervisor, string $inputName): array
    {
        $commandInput = $supervisor->getInputs()[$inputName]->getInput();

        $pieces = preg_split("/(\r\n|\n|\r)/", $commandInput, -1, PREG_SPLIT_NO_EMPTY);

        return preg_replace('/^\//', '', $pieces);
    }

    /**
     * @inheritDoc
     */
    public static function buildOptions(FormRequest $request): ToolOptions
    {
        $options = new ToolOptions();
        $data = $request->validated();

        $minecraft = new Minecraft(
            Uuid::fromString($data['options']['game']['edition'] ?? ToolOptions::GAME_EDITION_DEFAULT),
            Uuid::fromString($data['options']['game']['version'] ?? ToolOptions::GAME_VERSION_DEFAULT)
        );
        $createObjective = Boolean::normalize($data['options'][self::OPTION_CREATE_OBJECTIVE] ?? false);

        // Customization options.

        $subfolderInput = $data['options'][self::OPTION_SUBFOLDER] ?? '';
        $subfolder = !empty($subfolderInput) ? $subfolderInput . '/' : '';

        $options->setOption(self::OPTION_NAMESPACE, $data['options'][self::OPTION_NAMESPACE] ?? 'vdv_raycast');
        $options->setOption(self::OPTION_SUBFOLDER, $subfolder);
        $options->setOption(self::OPTION_OBJECTIVE, $data['options'][self::OPTION_OBJECTIVE] ?? 'vdvcasttemp');
        $options->setOption(self::OPTION_CREATE_OBJECTIVE, $createObjective);
        $options->setOption(self::OPTION_TAG, $data['options'][self::OPTION_TAG] ?? 'vdvray');
        $options->setOption(ToolOptions::GAME, $minecraft);

        // Method options.

        $options->setOption('method', $data['detection']['method']);

        return $options;
    }

    /**
     * @inheritDoc
     */
    public static function buildInputs(FormRequest $request): ToolInputs
    {
        $data = $request->validated();
        $inputs = new ToolInputs();
        $blocksInverted = Boolean::normalize($data['detection'][self::METHOD_BLOCK]['inverted'] ?? false);

        // Detection inputs.

        $inputs[self::METHOD_ENTITIES] = new ToolInput(self::METHOD_ENTITIES, $data['detection'][self::METHOD_ENTITY][self::METHOD_ENTITIES] ?? []);
        $inputs[self::METHOD_BLOCKS] = new ToolInput(self::METHOD_BLOCKS, $data['detection'][self::METHOD_BLOCK][self::METHOD_BLOCKS] ?? []);
        $inputs[self::METHOD_BLOCKS_INVERTED] = new ToolInput(self::METHOD_BLOCKS_INVERTED, $blocksInverted);
        $inputs[self::METHOD_MAX_DISTANCE] = new ToolInput(self::METHOD_MAX_DISTANCE, $data['detection'][self::METHOD_MAX_DISTANCE] ?? self::MAX_DISTANCE_DEFAULT);
        $inputs[self::METHOD_STEP_DISTANCE] = new ToolInput(self::METHOD_STEP_DISTANCE, $data['detection'][self::METHOD_STEP_DISTANCE] ?? self::STEP_DISTANCE_DEFAULT);
        $inputs[self::METHOD_UNITS] = new ToolInput(self::METHOD_UNITS, $data['detection'][self::METHOD_UNITS] ?? self::UNITS_DEFAULT);

        // Command inputs.

        foreach (self::getCommandSectionNames() as $section) {

            $inputs[$section] = new ToolInput($section, $data['commands'][$section] ?? '');
        }

        // Return completed set of inputs.

        return $inputs;
    }

    /**
     * @inheritDoc
     */
    public static function getRequiredRegistries(Minecraft $minecraft): array
    {
        return [EntityTypes::class, Blocks::class];
    }

    /**
     * @inheritDoc
     */
    public function getCategory(): int
    {
        return ToolInterface::GENERATOR;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'raycasting_generator';
    }
}
