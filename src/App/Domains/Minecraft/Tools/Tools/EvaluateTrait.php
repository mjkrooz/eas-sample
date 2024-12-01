<?php namespace App\Domains\Minecraft\Tools\Tools;

use App\Domains\Minecraft\Tools\Outputs\Feedback\Context\AbstractContext;
use App\Domains\Minecraft\Tools\Outputs\Feedback\FeedbackMessage;
use App\Domains\Minecraft\Tools\Outputs\Feedback\FeedbackMessages;
use App\Domains\Minecraft\Tools\ToolInput;
use App\Domains\Minecraft\Tools\ToolOptions;
use App\Domains\Minecraft\Tools\ToolSupervisor;
use Celestriode\Constructure\AbstractConstructure;
use Celestriode\Constructure\Exceptions\AbstractConstructureException;
use Celestriode\Constructure\Exceptions\ConversionFailureException;
use Celestriode\Constructure\Structures\StructureInterface;
use stdClass;
use function abort;

trait EvaluateTrait
{
    /**
     * Evaluates a single structure using the provided constructure, expected structure, and input.
     *
     * @param ToolSupervisor $supervisor
     * @param AbstractConstructure $constructure
     * @param StructureInterface $expectedStructure
     * @param ToolInput $input
     * @return array
     */
    protected function evaluateStructure(ToolSupervisor $supervisor, AbstractConstructure $constructure, StructureInterface $expectedStructure, ToolInput $input): array
    {
        // Begin the buffer.

        $passes = false;
        $messages = [
            'fatal' => []
        ];
        $statistics = new stdClass();

        // Perform the evaluation.

        try {

            // Build and validate the input structure with the expected structure. Store whether it succeeds.

            $passes = $constructure->validate($constructure->toStructure($input->getInput()), $expectedStructure);
        } catch (ConversionFailureException $e) {

            // If there is an issue with parsing via constructure, add the message as a fatal error.

            $fatal = [
                'message' => $e->getMessage(),
            ];

            $messages['fatal'][] = $fatal;
        } catch (AbstractConstructureException $e) {

            // If there is an issue with constructure, 500.

            abort(500, $e->getMessage());
        }

        // Evaluation complete, fill in the buffer with the results of the evaluation.

        $buffer = [
            //'input' => $input,
            'id' => $input->getId(),
            'passes' => $passes
        ];

        // If messages are requested, include them.

        if ($supervisor->getOptions()->getOption(ToolOptions::FEEDBACK)) {

            $feedback = $supervisor->getFeedbackMessages();

            $buffer['feedback'] = [
                'fatal' => array_merge($messages['fatal'], $this->buildMessages($supervisor, ...$feedback->getMessages(FeedbackMessages::FATAL))),
                'error' => $this->buildMessages($supervisor, ...$feedback->getMessages(FeedbackMessages::ERROR)),
                'warning' => $this->buildMessages($supervisor, ...$feedback->getMessages(FeedbackMessages::WARNING)),
                'debug' => ($supervisor->getOptions()->getOption(ToolOptions::DEBUG) ? $this->buildMessages($supervisor, ...$feedback->getMessages(FeedbackMessages::DEBUG)) : [])
            ];
        }

        // If statistics are requested, include them.

        if ($supervisor->getOptions()->getOption(ToolOptions::STATISTICS)) {

            $buffer['statistics'] = $statistics;
        }

        // TODO: components.

        if ($supervisor->getOptions()->getOption(ToolOptions::COMPONENTS)) {

            $buffer['components'] = new stdClass();
        }

        // Return the completed buffer.

        return $buffer;
    }

    /**
     * Builds message and context for all supplied messages for use with the API.
     *
     * @param ToolSupervisor $supervisor
     * @param FeedbackMessage ...$messages The feedback messages to build an output from.
     * @return array
     */
    protected function buildMessages(ToolSupervisor $supervisor, FeedbackMessage ...$messages): array
    {
        $buffer = [];
        $debug = $supervisor->getOptions()->getOption(ToolOptions::DEBUG);

        // Cycle through each event message.

        foreach ($messages as $message) {

            // Map the contexts of the message to their outputs.

            $contexts = array_map(function (AbstractContext $context) use ($debug) {

                return $context->toOutput();
            }, $message->getContexts($debug));

            // Add the message and contexts to the buffer.

            $buffer[] = [
                'message' => $message->getMessage(),
                'context' => $contexts
            ];
        }

        // Return the completed buffer.

        return $buffer;
    }
}
