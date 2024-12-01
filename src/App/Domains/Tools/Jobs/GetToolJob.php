<?php namespace App\Domains\Tools\Jobs;

use App\Domains\Minecraft\Tools\ToolInterface;
use App\Domains\Minecraft\Tools\Tools;
use Lucid\Units\Job;

class GetToolJob extends Job
{
    private string $className;

    private array $inputs;

    public function __construct(string $className, array $inputs)
    {
        $this->className = $className;
        $this->inputs = $inputs;
    }

    public function handle(): ToolInterface
    {
        return Tools::getTool($this->className, ...$this->inputs);
    }
}
