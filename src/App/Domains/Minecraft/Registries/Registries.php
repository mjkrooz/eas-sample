<?php namespace App\Domains\Minecraft\Registries;

use Celestriode\DynamicMinecraftRegistries\Bedrock\Data\LootTables;
use Celestriode\DynamicMinecraftRegistries\Bedrock\Game\Registries\EntityFamilies;
use Celestriode\DynamicMinecraftRegistries\Bedrock\Other\SelectorTargets;
use Celestriode\DynamicMinecraftRegistries\Java\Data\AdvancementTriggers;
use Celestriode\DynamicMinecraftRegistries\Java\Data\Tags\EntityTypeTags;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Colors;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\EntityTypes;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Registries\Items;
use Celestriode\DynamicMinecraftRegistries\Java\Resources\Fonts;
use Celestriode\DynamicMinecraftRegistries\Java\Resources\Keybinds;
use Celestriode\DynamicMinecraftRegistries\Java\Resources\Translations;
use Celestriode\DynamicRegistry\AbstractRegistry;
use Celestriode\DynamicRegistry\Exception\InvalidValue;
use InvalidArgumentException;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Holds a mapping of Minecraft registries to UUID, which can be used for APIs.
 *
 * Allows evaluators to reference a registry without having to send a huge, huge, huge amount of data.
 *
 * TODO: this will eventually be replaced by Source Block's database system, where a lookup to a registry happens within
 * TODO: the database API instead.
 *
 * @package App\Domains\Minecraft\Registries
 */
final class Registries
{
    private static array $uuidToRegistry = [];
    private static array $registryToUuid = [];

    /**
     * @var bool Whether or not the populateRegistries() method has been called yet.
     */
    private static bool $registered = false;

    /**
     * Registers some default registries. These will eventually be replaced by database-stored registries.
     */
    public static function populateRegistries(): void
    {
        if (!self::$registered) {

            // All Java registries.

            self::$uuidToRegistry['9adb89c9-c4a5-4742-835c-c88cf0754074'] = Colors::class;
            self::$uuidToRegistry['e9ba75ba-4fc9-4845-90bb-8115f2e8f7c0'] = EntityTypes::class;
            self::$uuidToRegistry['1b0ca709-55ba-4a8c-aa6e-5f83289cfe37'] = Fonts::class;
            self::$uuidToRegistry['f67ceef4-8720-4d98-9daa-333a5c9d4802'] = Items::class;
            self::$uuidToRegistry['bc5ad5b2-1930-4835-9f82-0744c1e63a10'] = Keybinds::class;
            self::$uuidToRegistry['69610345-30c5-4db3-a6f4-da3f0504389d'] = Translations::class;
            self::$uuidToRegistry['ea56f5f9-ab3f-42ba-88fc-8b8be4e33228'] = AdvancementTriggers::class;
            self::$uuidToRegistry['ad30293c-09c5-4d63-a416-6655ea60c1db'] = EntityTypeTags::class; // TODO: extract to repo.
            self::$uuidToRegistry['f96be3c7-cd34-41fa-a5ab-287488fe99e7'] = \Celestriode\DynamicMinecraftRegistries\Java\Game\Gamemodes::class;
            self::$uuidToRegistry['0adf003c-f50e-4ee1-962d-36827f046de4'] = \Celestriode\DynamicMinecraftRegistries\Java\Other\SelectorTargets::class;

            // All Bedrock registries

            self::$uuidToRegistry['4163f1b3-f4fc-406c-bdd3-4cb4c1a831f0'] = \Celestriode\DynamicMinecraftRegistries\Bedrock\Game\Registries\EntityTypes::class;
            self::$uuidToRegistry['63bb05a4-eb8c-48e4-8911-c6af903d0d02'] = EntityFamilies::class;
            self::$uuidToRegistry['820746c2-a836-476d-a0e9-4aec02e04f9f'] = \Celestriode\DynamicMinecraftRegistries\Bedrock\Game\Gamemodes::class;
            self::$uuidToRegistry['06fec4af-cbba-4e42-a3d0-ed90621356f7'] = \Celestriode\DynamicMinecraftRegistries\Bedrock\Resources\Translations::class;
            self::$uuidToRegistry['f4a757a4-7885-40b5-aa14-f8bff344e43e'] = SelectorTargets::class;
            self::$uuidToRegistry['179208d0-2015-4efa-be9c-cf84f634d882'] = LootTables::class;

            self::$registryToUuid = array_flip(self::$uuidToRegistry);

            self::$registered = true;
        }
    }

    public static function register(UuidInterface $uuid, string $class): void
    {
        if (!isset(self::$registryToUuid[$class])) {

            $uuidString = $uuid->toString();

            self::$registryToUuid[$class] = $uuidString;
            self::$uuidToRegistry[$uuidString] = $class;
        }
    }

    /**
     * @throws InvalidValue
     */
    public static function getRegistry(UuidInterface $uuid): AbstractRegistry
    {
        $registry = self::$uuidToRegistry[$uuid->toString()] ?? null;

        if ($registry === null || !is_subclass_of($registry, AbstractRegistry::class)) {

            throw new InvalidArgumentException('Invalid registry: ' . $uuid->toString());
        }

        return $registry::get();
    }

    public static function getUuidFromRegistry(AbstractRegistry $registry): UuidInterface
    {
        $uuid = self::$registryToUuid[$registry::class] ?? null;

        if ($uuid === null) {

            throw new InvalidArgumentException('Invalid registry: ' . $registry->getName());
        }

        return Uuid::fromString($uuid);
    }
}
