<?php namespace App\Domains\Minecraft\Tools;

use Celestriode\Constructure\Context\Events\EventHandlerInterface;

class EvaluatorSupervisor extends ToolSupervisor
{
    private EventHandlerInterface $eventHandler;

    public function setEventHandler(EventHandlerInterface $eventHandler): void
    {
        $this->eventHandler = $eventHandler;
    }

    public function getEventHandler(): EventHandlerInterface
    {
        return $this->eventHandler;
    }
}
