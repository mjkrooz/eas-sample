<?php namespace App\Domains\Minecraft\Packs;

use Celestriode\Mattock\Parsers\Java\Utils\ResourceLocation;

interface PackInterface
{
    public function setResourceLocation(ResourceLocation $location): void;

    public function getResourceLocation(): ResourceLocation;

    public function getResourceNamespace(): string;

    public function getResourcePath(): string;

    public function getPath(): string;

    public function getFullPath(): string;

    public function toString(bool $pretty = false): string;

    public static function getExtension(): string;
}
