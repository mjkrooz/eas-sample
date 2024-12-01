<?php namespace App\Domains\Minecraft\Tools\Supervisor;

use Celestriode\Constructure\Context\Events\EventHandlerInterface;

trait EventHandlerTrait
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
