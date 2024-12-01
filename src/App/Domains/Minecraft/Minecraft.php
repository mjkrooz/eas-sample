<?php namespace App\Domains\Minecraft;

use Ramsey\Uuid\UuidInterface;

/**
 * An overarching representation of Minecraft as used by Source Block. This primarily dictates what data the user is
 * viewing. In particular, it checks the edition and version of Minecraft to change, for example, the registries that
 * will be used when evaluating content.
 *
 * @package App\Domains\Minecraft
 */
final class Minecraft
{
    /**
     * TODO: temporary until a database is created.
     */
    public const JAVA = '2a9bb85b-c29b-49bb-ab5f-7cc1994a381c';
    public const BEDROCK = '422dc938-5bc9-469b-a224-43e121e14770';
    public const NONE = '00000000-0000-0000-0000-000000000000';

    /**
     * @var UuidInterface The Minecraft edition. TODO: edition object?
     */
    private UuidInterface $edition;

    /**
     * @var UuidInterface The Minecraft version. TODO: version object?
     */
    private UuidInterface $version;

    public function __construct(UuidInterface $edition, UuidInterface $version)
    {
        $this->edition = $edition;
        $this->version = $version;
    }

    /**
     * Returns the edition to use.
     *
     * @return UuidInterface
     */
    public function getEdition(): UuidInterface
    {
        return $this->edition;
    }

    /**
     * Returns the version within the edition to use.
     *
     * @return UuidInterface
     */
    public function getVersion(): UuidInterface
    {
        return $this->version;
    }
}
