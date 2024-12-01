<?php namespace App\Domains\Lectern;

use App\Domains\Minecraft\Packs\DataPack;

class Lectern
{
    private DataPack $dataPack;

    public function setDataPack(DataPack $dataPack): void
    {
        $this->dataPack = $dataPack;
    }

    public function getDataPack(): ?DataPack
    {
        return $this->dataPack;
    }

    public function toSource($reduced = false): string
    {
        $meta = $this->getDataPack()->getPackMcMeta();
        $source = [];

        // Add the pack.mcmeta directive.

        $source[] = '`@data_pack pack.mcmeta`';
        $source[] = '```';
        $source[] = $meta->toString();
        $source[] = '```';

        // Add the function directives.

        foreach ($this->getDataPack()->getFunctions() as $function) {

            $source[] = '';
            $source[] = '`@function ' . $function->getResourceLocation()->toString() . '`';
            $source[] = '```';
            $source[] = $function->toString(false, !$reduced);
            $source[] = '```';
        }

        // Add the tag directives.

        foreach ($this->getDataPack()->getTags() as $tag) {

            $source[] = '';

            $category = match ($tag->getCategory()) {
                DataPack\Tag::TAG_BLOCKS => 'block_tag',
                DataPack\Tag::TAG_FUNCTIONS => 'function_tag',
                DataPack\Tag::TAG_FLUIDS => 'fluid_tag',
                DataPack\Tag::TAG_ITEMS => 'item_tag',
                DataPack\Tag::TAG_GAME_EVENTS => 'game_event_tag',
                default => 'entity_type_tag',
            };

            $source[] = '`@' . $category . ' ' . $tag->getResourceLocation()->toString() . '`';
            $source[] = '```';
            $source[] = $tag->toString(); // TODO: turn this into a lectern URL using a search on source block in the future.
            $source[] = '```';
        }

        return implode(PHP_EOL, $source);
    }
}
