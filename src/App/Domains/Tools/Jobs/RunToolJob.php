<?php namespace App\Domains\Tools\Jobs;

use App\Domains\Minecraft\Tools\ToolInterface;
use App\Domains\Minecraft\Tools\ToolOutputs;
use App\Domains\Minecraft\Tools\ToolSupervisor;
use Lucid\Units\Job;

class RunToolJob extends Job
{
    private ToolInterface $tool;
    private ToolSupervisor $supervisor;

    public function __construct(ToolInterface $tool, ToolSupervisor $supervisor)
    {
        $this->tool = $tool;
        $this->supervisor = $supervisor;
    }

    public function handle(): ToolOutputs
    {
        $this->tool->runTool($this->supervisor);

        return $this->supervisor->getOutputs();
    }
}
