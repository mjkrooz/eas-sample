<?php namespace App\Domains\Minecraft\Registries;

use App\Domains\Minecraft\Minecraft;
use App\Domains\Minecraft\Registries\Populators\ArcMcDataPopulator;
use App\Domains\Minecraft\Registries\Populators\SBTranslationsPopulator;
use Celestriode\ConstructuresMinecraft\Utils\Populators\ColorsPopulator;
use Celestriode\ConstructuresMinecraft\Utils\Populators\FontsPopulator;
use Celestriode\ConstructuresMinecraft\Utils\Populators\KeybindsPopulator;
use Celestriode\ConstructuresMinecraft\Utils\Populators\TranslationsPopulator;
use Celestriode\ConstructuresMinecraft\Utils\Populators\TriggersPopulator;
use Celestriode\DynamicMinecraftRegistries\Bedrock\Game\Registries\EntityFamilies;
use Celestriode\DynamicMinecraftRegistries\Java\Data\AdvancementTriggers;
use Celestriode\DynamicMinecraftRegistries\Java\Data\Tags\BlockTags;
use Celestriode\DynamicMinecraftRegistries\Java\Data\Tags\EntityTypeTags;
use Celestriode\DynamicMinecraftRegistries\Java\Data\Tags\FluidsTags;
use Celestriode\DynamicMinecraftRegistries\Java\Data\Tags\GameEventTags;
use Celestriode\DynamicMinecraftRegistries\Java\Data\Tags\ItemTags;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Colors;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Gamemodes;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\Activities;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\Attributes;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\BlockEntityTypes;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\BlockPredicateTypes;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\Blocks;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\CustomStats;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\Enchantments;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\EntityTypes;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\FloatProviderTypes;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\Fluids;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\GameEvents;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\HeightProviderTypes;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\IntProviderTypes;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\Items;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\LootConditionTypes;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\LootFunctionTypes;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\LootNbtProviderTypes;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\LootNumberProviderTypes;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\LootPoolEntryTypes;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\LootScoreProviderTypes;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\MemoryModuleTypes;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\Menus;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\MobEffects;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\Motives;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\ParticleTypes;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\PointOfInterestTypes;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\PositionSourceTypes;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\PosRuleTests;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\Potions;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\RecipeSerializers;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\RecipeTypes;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\RuleTests;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\Schedules;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\SensorTypes;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\SoundEvents;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\StatTypes;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\VillagerProfessions;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\VillagerTypes;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\WorldGens;
use Celestriode\DynamicMinecraftRegistries\Java\Other\SelectorTargets;
use Celestriode\DynamicMinecraftRegistries\Java\Resources\Fonts;
use Celestriode\DynamicMinecraftRegistries\Java\Resources\Keybinds;
use Celestriode\DynamicMinecraftRegistries\Java\Resources\Translations;
use Celestriode\DynamicRegistry\Exception\InvalidValue;

final class StandardPopulators
{
    /**
     * @throws InvalidValue
     */
    public static function register(Minecraft $minecraft): void
    {
        if ($minecraft->getEdition() == Minecraft::BEDROCK) { // TODO: differentiate between edition & version.

            // Bedrock Edition

            \Celestriode\DynamicMinecraftRegistries\Bedrock\Game\Registries\EntityTypes::get()->register(ArcMcDataPopulator::make('entity_type'));
            \Celestriode\DynamicMinecraftRegistries\Bedrock\Resources\Translations::get()->register(new TranslationsPopulator());
            \Celestriode\DynamicMinecraftRegistries\Bedrock\Game\Gamemodes::get('survival', 'creative', 'adventure', 's', 'c', 'a', '0', '1', '2'); // TODO: dynamic population.
            \Celestriode\DynamicMinecraftRegistries\Bedrock\Other\SelectorTargets::get('p', 'e', 'a', 'r', 's'); // TODO: dynamic population.
            EntityFamilies::get();
        } else {

            // Java Edition

            // ARC MCDATA REGISTRIES

            Activities::get()->register(ArcMcDataPopulator::make('activity'));
            Attributes::get()->register(ArcMcDataPopulator::make('attribute'));
            Blocks::get()->register(ArcMcDataPopulator::make('block'));
            BlockEntityTypes::get()->register(ArcMcDataPopulator::make('block_entity_type'));
            BlockPredicateTypes::get()->register(ArcMcDataPopulator::make('block_predicate_type'));
            CustomStats::get()->register(ArcMcDataPopulator::make('custom_stat'));
            Enchantments::get()->register(ArcMcDataPopulator::make('enchantment'));
            EntityTypes::get()->register(ArcMcDataPopulator::make('entity_type'));
            FloatProviderTypes::get()->register(ArcMcDataPopulator::make('float_provider_type'));
            Fluids::get()->register(ArcMcDataPopulator::make('fluid'));
            GameEvents::get()->register(ArcMcDataPopulator::make('game_event'));
            HeightProviderTypes::get()->register(ArcMcDataPopulator::make('height_provider_type'));
            IntProviderTypes::get()->register(ArcMcDataPopulator::make('int_provider_type'));
            Items::get()->register(ArcMcDataPopulator::make('item'));
            LootConditionTypes::get()->register(ArcMcDataPopulator::make('loot_condition_type'));
            LootFunctionTypes::get()->register(ArcMcDataPopulator::make('loot_function_type'));
            LootNbtProviderTypes::get()->register(ArcMcDataPopulator::make('loot_nbt_provider_type'));
            LootNumberProviderTypes::get()->register(ArcMcDataPopulator::make('loot_number_provider_type'));
            LootPoolEntryTypes::get()->register(ArcMcDataPopulator::make('loot_pool_entry_type'));
            LootScoreProviderTypes::get()->register(ArcMcDataPopulator::make('loot_score_provider_type'));
            MemoryModuleTypes::get()->register(ArcMcDataPopulator::make('memory_module_type'));
            Menus::get()->register(ArcMcDataPopulator::make('menu'));
            MobEffects::get()->register(ArcMcDataPopulator::make('mob_effect'));
            Motives::get()->register(ArcMcDataPopulator::make('motive'));
            ParticleTypes::get()->register(ArcMcDataPopulator::make('particle_type'));
            PointOfInterestTypes::get()->register(ArcMcDataPopulator::make('point_of_interest_type'));
            PosRuleTests::get()->register(ArcMcDataPopulator::make('pos_rule_test'));
            PositionSourceTypes::get()->register(ArcMcDataPopulator::make('position_source_type'));
            Potions::get()->register(ArcMcDataPopulator::make('potion'));
            RecipeSerializers::get()->register(ArcMcDataPopulator::make('recipe_serializer'));
            RecipeTypes::get()->register(ArcMcDataPopulator::make('recipe_type'));
            RuleTests::get()->register(ArcMcDataPopulator::make('rule_test'));
            Schedules::get()->register(ArcMcDataPopulator::make('schedule'));
            SensorTypes::get()->register(ArcMcDataPopulator::make('sensor_type'));
            SoundEvents::get()->register(ArcMcDataPopulator::make('sound_event'));
            StatTypes::get()->register(ArcMcDataPopulator::make('stat_type'));
            VillagerProfessions::get()->register(ArcMcDataPopulator::make('villager_profession'));
            VillagerTypes::get()->register(ArcMcDataPopulator::make('villager_type'));
            WorldGens::get()->register(ArcMcDataPopulator::make('worldgen'));

            // ARC MCDATA TAGS

            BlockTags::get()->register(ArcMcDataPopulator::make('blocks', ArcMcDataPopulator::TYPE_TAG));
            EntityTypeTags::get()->register(ArcMcDataPopulator::make('entity_types', ArcMcDataPopulator::TYPE_TAG));
            FluidsTags::get()->register(ArcMcDataPopulator::make('fluids', ArcMcDataPopulator::TYPE_TAG));
            GameEventTags::get()->register(ArcMcDataPopulator::make('game_events', ArcMcDataPopulator::TYPE_TAG));
            ItemTags::get()->register(ArcMcDataPopulator::make('items', ArcMcDataPopulator::TYPE_TAG));

            // OTHER

            Colors::get()->register(new ColorsPopulator());
            Fonts::get()->register(new FontsPopulator());
            Keybinds::get()->register(new KeybindsPopulator());
            Translations::get()->register(new SBTranslationsPopulator());
            AdvancementTriggers::get()->register(new TriggersPopulator());
            Gamemodes::get('survival', 'creative', 'adventure', 'spectator'); // TODO: dynamic population.
            SelectorTargets::get('p', 'e', 'a', 'r', 's'); // TODO: dynamic population.
        }
    }
}
