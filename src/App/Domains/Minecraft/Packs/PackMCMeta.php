<?php namespace App\Domains\Minecraft\Packs;

use Celestriode\Mattock\Parsers\Java\Utils\ResourceLocation;

class PackMCMeta implements PackInterface
{
    public const DEFAULT_PACK_FORMAT = 10;

    use PackTrait;

    protected string $description;
    protected int $packFormat;

    public function __construct(string $description, int $packFormat = self::DEFAULT_PACK_FORMAT)
    {
        $this->description = $description;
        $this->packFormat = $packFormat;
        $this->setResourceLocation(new ResourceLocation('none', 'none'));
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPackFormat(): int
    {
        return $this->packFormat;
    }

    public function toString(bool $pretty = false): string
    {
        $packMCMeta = new \stdClass();
        $packMCMeta->pack = new \stdClass();
        $packMCMeta->pack->pack_format = $this->getPackFormat();
        $packMCMeta->pack->description = $this->getDescription();

        $flags = ($pretty) ? JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES : JSON_UNESCAPED_SLASHES;

        return json_encode($packMCMeta, $flags);
    }

    public function getPath(): string
    {
        return '/pack';
    }

    public static function getExtension(): string
    {
        return '.mcmeta';
    }

    public function getFullPath(): string
    {
        return $this->getPath() . self::getExtension();
    }

    protected function getIntermediatePath(): string
    {
        return 'none';
    }
}
