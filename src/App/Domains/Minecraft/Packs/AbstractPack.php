<?php namespace App\Domains\Minecraft\Packs;

use ZipStream\Option\Archive;
use ZipStream\ZipStream;

abstract class AbstractPack
{
    public const PACK_FORMAT = 7;
    public const PACK_EXTENSION = '.zip';

    /**
     * @var string The name of the pack, which can be used for the name of zip files for download.
     */
    private string $packName;

    /**
     * @var PackMCMeta The pack.mcmeta of the pack.
     */
    private PackMCMeta $meta;

    /**
     * @var ZipStream The zip archive to write the files to when zip() is called.
     */
    private ZipStream $stream;

    /**
     * @var PackFile[] List of files to be zipped. Emptied when calling zip().
     */
    private array $files;

    public function __construct(string $packName, ZipStream $stream)
    {
        $this->packName = $packName;
        $this->stream = $stream;
    }

    /**
     * Sets the pack.mcmeta of the pack.
     *
     * @param PackMCMeta $meta
     * @return void
     */
    public function setPackMcMeta(PackMCMeta $meta): void
    {
        $this->meta = $meta;

        $this->addFile(new PackFile($meta->getPath(), $meta::getExtension(), $meta->toString()));
    }

    /**
     * Returns the pack.mcmeta of the pack.
     *
     * @return PackMCMeta
     */
    public function getPackMcMeta(): PackMCMeta
    {
        return $this->meta;
    }

    /**
     * Returns the name of the pack, without extension. Add .zip for the filename.
     *
     * @return string
     */
    public function getPackName(): string
    {
        return $this->packName;
    }

    /**
     * Returns the zip archive associated with this pack.
     *
     * @return ZipStream
     */
    public function getStream(): ZipStream
    {
        return $this->stream;
    }

    /**
     * Adds a file to this pack.
     *
     * @param PackFile $file
     * @return void
     */
    public function addFile(PackFile $file): void
    {
        $this->files[] = $file;
    }

    /**
     * Returns all files that haven't been zipped yet.
     *
     * @return PackFile[]
     */
    public function getFiles(): array
    {
        return $this->files;
    }

    /**
     * Adds all current files to the zip archive and empties the list of current files. Returns the zip archive.
     *
     * @return ZipStream
     */
    public function zip(): ZipStream
    {
        ob_end_clean();

        foreach ($this->getFiles() as $file) {

            $this->getStream()->addFile($file->getFullPath(), $file->getContents());
        }

        $this->files = [];

        return $this->getStream();
    }

    /**
     * Creates a new instance of the pack with the appropriate zip stream and options.
     *
     * @param string $packName
     * @param bool $sendHeaders
     * @return static
     */
    final public static function make(string $packName, bool $sendHeaders = true): self
    {
        $archive = new Archive();

        if ($sendHeaders) {

            $archive->setSendHttpHeaders(true);
        }

        return new static($packName, new ZipStream($packName . self::PACK_EXTENSION, $archive));
    }
}
