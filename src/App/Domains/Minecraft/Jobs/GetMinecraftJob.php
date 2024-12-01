<?php namespace App\Domains\Minecraft\Jobs;

use App\Domains\Minecraft\Minecraft;
use Lucid\Units\Job;
use Ramsey\Uuid\UuidInterface;

class GetMinecraftJob extends Job
{
    private UuidInterface $edition;
    private UuidInterface $version;

    public function __construct(UuidInterface $edition, UuidInterface $version)
    {
        $this->edition = $edition;
        $this->version = $version;
    }

    public function handle(): Minecraft
    {
        return new Minecraft($this->edition, $this->version);
    }
}
