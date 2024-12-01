<?php namespace App\Domains\Minecraft\Tools;

use App\Domains\Minecraft\Tools\Outputs\Feedback\FeedbackMessages;
use App\Domains\Minecraft\Tools\Supervisor\EventHandlerTrait;
use RuntimeException;

class ToolSupervisor
{
    use EventHandlerTrait;

    /**
     * @var ToolOptions List of options for the tool to use.
     */
    private ToolOptions $options;

    /**
     * @var ToolInputs Collection of inputs that the tool will use.
     */
    private ToolInputs $inputs;

    /**
     * @var ToolOutputs Collection of outputs to provide to the user.
     */
    private ToolOutputs $outputs;

    /**
     * @var int Of the inputs being used for the tool, this states which one is currently being used. If a tool only
     * uses a single input, then this value is effectively unused.
     */
    private int $currentInput = 0;

    /**
     * @var FeedbackMessages[] The event messages associated with this evaluation.
     */
    private array $feedbackMessages;

    public function __construct(ToolOptions $options, ToolInputs $inputs, ToolOutputs $outputs = null)
    {
        $this->options = $options;
        $this->inputs = $inputs;
        $this->outputs = $outputs ?? new ToolOutputs();
    }

    /**
     * Returns the options for the tool to use.
     *
     * @return ToolOptions
     */
    public function getOptions(): ToolOptions
    {
        return $this->options;
    }

    /**
     * Returns all inputs.
     *
     * @return ToolInputs
     */
    public function getInputs(): ToolInputs
    {
        return $this->inputs;
    }

    /**
     * Gets the input currently being evaluated.
     *
     * @return ToolInput
     */
    public function getCurrentInput(): ToolInput
    {
        return $this->inputs[$this->currentInput];
    }

    /**
     * Returns the index within the list of inputs that the supervisor is currently at.
     *
     * @return int
     */
    public function getCurrentInputIndex(): int
    {
        return $this->currentInput;
    }

    /**
     * Moves to the next input to evaluate. If no more are available, returns null.
     *
     * @return ToolInput|null
     */
    public function getNextInput(): ?ToolInput
    {
        return $this->inputs[$this->currentInput++] ?? null;
    }

    /**
     * Adds a single output to the supervisor.
     *
     * @param ToolOutput $output The output to add.
     * @return $this
     */
    public function setOutput(string $name, ToolOutput $output): self
    {
        $this->outputs[$name] = $output;

        return $this;
    }

    /**
     * Returns a single output based on its name.
     *
     * @param string $name The name of the output to return.
     * @return ToolOutput
     */
    public function getOutput(string $name): ToolOutput
    {
        if (!isset($this->outputs[$name])) {

            throw new RuntimeException('Output "' . $name . '" does not exist');
        }

        return $this->outputs[$name];
    }

    /**
     * Returns all outputs.
     *
     * @return ToolOutputs
     */
    public function getOutputs(): ToolOutputs
    {
        return $this->outputs;
    }

    /**
     * Returns the event messages associated with the current evaluation. When the next input is requested, a new
     * instance of event messages is created to coincide with that input.
     *
     * @param int $index The optional index if wanting a specific collection of messages.
     * @return FeedbackMessages|null
     */
    public function getFeedbackMessages(int $index = -1): ?FeedbackMessages
    {
        // If an index was supplied, return it or null.

        if ($index != -1) {

            return $this->feedbackMessages[$index] ?? null;
        }

        // If there is no event message collector for the current input, make it.

        if (!isset($this->feedbackMessages[$this->currentInput])) {

            // If there are no more inputs, return null.

            if ($this->currentInput > count($this->inputs)) {

                return null;
            }

            // Otherwise, make and return event messages for the input.

            return $this->feedbackMessages[$this->currentInput] = new FeedbackMessages($this);
        }

        // Otherwise, return the current input's event messages.

        return $this->feedbackMessages[$this->currentInput];
    }

    /**
     * Returns all event messages for the inputs.
     *
     * @return FeedbackMessages[]
     */
    public function getAllFeedbackMessages(): array
    {
        return $this->feedbackMessages;
    }
}
