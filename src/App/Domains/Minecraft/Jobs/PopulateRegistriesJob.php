<?php namespace App\Domains\Minecraft\Jobs;

use Lucid\Units\Job;

class PopulateRegistriesJob extends Job
{
    private array $registries;

    public function __construct(array $registries)
    {
        $this->registries = $registries;
    }

    public function handle(): void
    {
        foreach ($this->registries as $registry) {

            $registry::get()->populate();
        }
    }
}
