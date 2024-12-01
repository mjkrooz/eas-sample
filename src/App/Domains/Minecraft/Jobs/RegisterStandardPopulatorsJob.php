<?php namespace App\Domains\Minecraft\Jobs;

use App\Domains\Minecraft\Minecraft;
use App\Domains\Minecraft\Registries\StandardPopulators;
use Lucid\Units\Job;

class RegisterStandardPopulatorsJob extends Job
{
    private Minecraft $minecraft;

    public function __construct(Minecraft $minecraft)
    {
        $this->minecraft = $minecraft;
    }

    public function handle(): void
    {
        StandardPopulators::register($this->minecraft);
    }
}
