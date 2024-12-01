<?php namespace App\Domains\Minecraft\Packs;

use Celestriode\Mattock\Parsers\Java\Utils\ResourceLocation;

trait PackTrait
{
    protected ResourceLocation $location;

    public function setResourceLocation(ResourceLocation $location): void
    {
        $this->location = $location;
    }

    public function getResourceLocation(): ResourceLocation
    {
        return $this->location;
    }

    public function getResourceNamespace(): string
    {
        return $this->getResourceLocation()->getNamespace();
    }

    public function getResourcePath(): string
    {
        return $this->getResourceLocation()->getPath();
    }

    abstract protected function getIntermediatePath(): string;

    public function getPath(): string
    {
        return "/data/{$this->getResourceNamespace()}/{$this->getIntermediatePath()}/{$this->getResourcePath()}";
    }
}
