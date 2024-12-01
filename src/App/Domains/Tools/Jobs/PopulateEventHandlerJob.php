<?php namespace App\Domains\Tools\Jobs;

use App\Domains\Minecraft\Tools\Outputs\Events\AuditEvents;
use App\Domains\Minecraft\Tools\Outputs\Events\BasicEvents;
use App\Domains\Minecraft\Tools\Outputs\Events\MinecraftEvents;
use App\Domains\Minecraft\Tools\ToolOptions;
use App\Domains\Minecraft\Tools\ToolSupervisor;
use Lucid\Units\Job;

class PopulateEventHandlerJob extends Job
{
    /**
     * @var ToolSupervisor
     */
    private ToolSupervisor $supervisor;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ToolSupervisor $supervisor)
    {
        $this->supervisor = $supervisor;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        if ($this->supervisor->getOptions()->getOption(ToolOptions::FEEDBACK)) {

            BasicEvents::populateEventHandler($this->supervisor);
            AuditEvents::populateEventHandler($this->supervisor);
            MinecraftEvents::populateEventHandler($this->supervisor);
        }
    }
}
