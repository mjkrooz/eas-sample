<?php namespace App\Domains\Minecraft\Tools\Outputs\Feedback;

use App\Domains\Minecraft\Tools\ToolOptions;
use App\Domains\Minecraft\Tools\ToolSupervisor;

/**
 * Collection of feedback messages.
 */
class FeedbackMessages
{
    public const DEBUG = 1;
    public const WARNING = 2;
    public const ERROR = 3;
    public const FATAL = 4;

    /**
     * @var array An associative array where keys are the event level and values are an array of event messages.
     */
    private array $messages = [];

    /**
     * @var ToolSupervisor Whether debug messages should be accepted.
     */
    private ToolSupervisor $supervisor;

    public function __construct(ToolSupervisor $supervisor)
    {
        $this->supervisor = $supervisor;
    }

    /**
     * Returns the supervisor being used for evaluation.
     *
     * @return ToolSupervisor
     */
    public function getSupervisor(): ToolSupervisor
    {
        return $this->supervisor;
    }

    /**
     * Adds a single message to the list of messages based upon the supplied event level.
     *
     * @param int $level
     * @param FeedbackMessage $message
     */
    public function addMessage(int $level, FeedbackMessage $message): void
    {
        // If it's a debug message and debug messages are not accepted, do not add this message.

        if ($level == self::DEBUG && !$this->getSupervisor()->getOptions()->getOption(ToolOptions::DEBUG)) {

            return;
        }

        $this->messages[$level][] = $message;
    }

    /**
     * Returns all messages for the given event level.
     *
     * @param int $level The event level to get messages for.
     * @return FeedbackMessage[]
     */
    public function getMessages(int $level): array
    {
        return $this->messages[$level] ?? [];
    }

    /**
     * Returns all messages. Keys are event level, values are an array of event messages for that level.
     *
     * @return array
     */
    public function getAllMessages(): array
    {
        return $this->messages;
    }
}
