<?php namespace App\Domains\Minecraft\Packs\DataPack;

use App\Domains\Minecraft\Packs\PackInterface;
use App\Domains\Minecraft\Packs\PackTrait;
use Celestriode\Mattock\Parsers\Java\Utils\ResourceLocation;

class Tag implements PackInterface
{
    use PackTrait;

    public const TAG_FUNCTIONS = 'function';
    public const TAG_BLOCKS = 'block';
    public const TAG_ENTITY_TYPES = 'entity_type';
    public const TAG_FLUIDS = 'fluid';
    public const TAG_GAME_EVENTS = 'game_event';
    public const TAG_ITEMS = 'item';

    protected string $category;
    protected array $values = [];
    protected bool $replace;

    public function __construct(ResourceLocation $location, string $category, bool $replace = false, string ...$values)
    {
        $this->category = $category;
        $this->replace = $replace;

        $this->addValues(...$values);

        $this->setResourceLocation($location);
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getValues(): array
    {
        return $this->values;
    }

    public function getReplace(): bool
    {
        return $this->replace;
    }

    public function addValues(string ...$values): void
    {
        foreach ($values as $value) {

            $this->addValue($value);
        }
    }

    public function addValue(string $value): void
    {
        $this->values[] = $value;
    }

    public function getFullPath(): string
    {
        return $this->getPath() . self::getExtension();
    }

    public function toString(bool $pretty = false): string
    {
        $tag = new \stdClass();
        $tag->replace = $this->getReplace();
        $tag->values = $this->values;

        $flags = ($pretty) ? JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT : JSON_UNESCAPED_SLASHES;

        return json_encode($tag, $flags);
    }

    public static function getExtension(): string
    {
        return '.json';
    }

    protected function getIntermediatePath(): string
    {
        return 'tags/' . $this->getCategory();
    }
}
