<?php namespace App\Domains\Minecraft\Packs;

use Celestriode\Mattock\Parsers\Java\Utils\ResourceLocation;

class PackFile
{
    /**
     * @var string The filepath without extension.
     */
    private string $filepath;

    /**
     * @var string The extension of the file.
     */
    private string $extension;

    /**
     * @var string The contents of the file.
     */
    private string $contents;

    /**
     * @var ResourceLocation|null The resource location of the file, if applicable.
     */
    private ?ResourceLocation $resourceLocation;

    public function __construct(string $filepath, string $extension, string $contents, ResourceLocation $resourceLocation = null)
    {
        $this->filepath = $filepath;
        $this->extension = $extension;
        $this->contents = $contents;
        $this->resourceLocation = $resourceLocation;
    }

    /**
     * Returns the filepath without the extension.
     *
     * @return string
     */
    public function getFilepath(): string
    {
        return $this->filepath;
    }

    /**
     * Returns the extension only.
     *
     * @return string
     */
    public function getExtension(): string
    {
        return $this->extension;
    }

    /**
     * Returns the filepath including the extension.
     *
     * @return string
     */
    public function getFullPath(): string
    {
        return $this->getFilepath() . $this->getExtension();
    }

    /**
     * Returns the contents of the file.
     *
     * @return string
     */
    public function getContents(): string
    {
        return $this->contents;
    }

    /**
     * Returns the resource location of the file.
     *
     * @return ResourceLocation|null
     */
    public function getResourceLocation(): ?ResourceLocation
    {
        return $this->resourceLocation;
    }
}
