<?php namespace App\Domains\Minecraft\Jobs;

use App\Domains\Minecraft\Minecraft;
use Illuminate\Http\Request;
use Lucid\Units\Job;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class GetMinecraftFromRequestJob extends Job
{
    private ?UuidInterface $edition;
    private ?UuidInterface $version;

    public function __construct(UuidInterface $edition = null, UuidInterface $version = null)
    {
        $this->edition = $edition;
        $this->version = $version;
    }

    public function handle(Request $request): Minecraft
    {
        $edition = $this->edition ?? Uuid::fromString(Minecraft::JAVA);
        $version = $this->version ?? Uuid::fromString(Minecraft::NONE);

        return new Minecraft($edition, $version);
    }
}
