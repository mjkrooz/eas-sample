<?php namespace App\Domains\Minecraft\Packs;

use App\Domains\Minecraft\Packs\DataPack\MCFunction;
use App\Domains\Minecraft\Packs\DataPack\Tag;

/**
 * A data pack represented in a zip archive.
 *
 * TODO: eventually this should be adding things like Advancement or Function objects instead of strings.
 */
class DataPack extends AbstractPack
{
    /**
     * @var MCFunction[] The functions added to the data pack.
     */
    private array $functions = [];

    /**
     * @var Tag[] The tags added to the data pack.
     */
    private array $tags = [];

    /**
     * Adds a function to the data pack.
     *
     * @param MCFunction $function
     * @return void
     */
    public function addFunction(MCFunction $function): void
    {
        $this->functions[$function->getResourceLocation()->toString()] = $function;

        $this->addFile(new PackFile($function->getPath(), $function::getExtension(), $function->toString()));
    }

    /**
     * Returns a function with the specified resource location.
     *
     * @param string $name
     * @return MCFunction|null
     */
    public function getFunction(string $name): ?MCFunction
    {
        return $this->functions[$name] ?? null;
    }

    /**
     * Returns all the functions of the data pack.
     *
     * @return MCFunction[]
     */
    public function getFunctions(): array
    {
        return $this->functions;
    }

    /**
     * Adds a tag to the data pack.
     *
     * @param Tag $tag
     * @return void
     */
    public function addTag(Tag $tag): void
    {
        $this->tags[$tag->getResourceLocation()->toString()] = $tag;

        $this->addFile(new PackFile($tag->getPath(), $tag::getExtension(), $tag->toString()));
    }

    /**
     * Returns a tag with the specified resource location.
     *
     * @param string $name
     * @return Tag|null
     */
    public function getTag(string $name): ?Tag
    {
        return $this->tags[$name] ?? null;
    }

    /**
     * Returns all the tags of the data pack.
     *
     * @return Tag[]
     */
    public function getTags(): array
    {
        return $this->tags;
    }
}
