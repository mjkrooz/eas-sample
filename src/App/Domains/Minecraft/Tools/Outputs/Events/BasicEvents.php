<?php namespace App\Domains\Minecraft\Tools\Outputs\Events;

use App\Domains\Minecraft\Tools\Outputs\Feedback\Context\AuditContext;
use App\Domains\Minecraft\Tools\Outputs\Feedback\Context\GenericContext;
use App\Domains\Minecraft\Tools\Outputs\Feedback\Context\JsonContext;
use App\Domains\Minecraft\Tools\Outputs\Feedback\Context\StructureContext;
use App\Domains\Minecraft\Tools\Outputs\Feedback\FeedbackMessage;
use App\Domains\Minecraft\Tools\Outputs\Feedback\FeedbackMessages;
use App\Domains\Minecraft\Tools\ToolSupervisor;
use Celestriode\Constructure\Context\AuditInterface;
use Celestriode\Constructure\Context\Events\CapturedEvent;
use Celestriode\Constructure\Context\Events\EventHandler;
use Celestriode\Constructure\Structures\AbstractStructure;
use Celestriode\Constructure\Structures\StructureInterface;
use Celestriode\JsonConstructure\Structures\AbstractJsonStructure;
use Celestriode\JsonConstructure\Structures\Types\JsonObject;

final class BasicEvents
{
    public static function populateEventHandler(ToolSupervisor $supervisor): void
    {
        // AbstractStructure from Constructure.

        $supervisor->getEventHandler()->addEvent(AbstractStructure::AUDITS_START, self::getAuditsStart($supervisor));
        $supervisor->getEventHandler()->addEvent(AbstractStructure::AUDITS_COMPLETE, self::getAuditsComplete($supervisor));
        $supervisor->getEventHandler()->addEvent(AbstractStructure::AUDIT_PREDICATES_START, self::getAuditPredicatesStart($supervisor));
        $supervisor->getEventHandler()->addEvent(AbstractStructure::AUDIT_PREDICATES_COMPLETE, self::getAuditPredicatesComplete($supervisor));
        $supervisor->getEventHandler()->addEvent(AbstractStructure::AUDITS_DEFERRED_START, self::getAuditsDeferredStart($supervisor));
        $supervisor->getEventHandler()->addEvent(AbstractStructure::AUDITS_DEFERRED_END, self::getAuditsDeferredEnd($supervisor));
        $supervisor->getEventHandler()->addEvent(AbstractStructure::AUDIT_RUNNING, self::getAuditRunning($supervisor));
        $supervisor->getEventHandler()->addEvent(AbstractStructure::AUDIT_PASSED, self::getAuditPassed($supervisor));
        $supervisor->getEventHandler()->addEvent(AbstractStructure::AUDIT_FAILED, self::getAuditFailed($supervisor));

        // EventHandler from Constructure.

        $supervisor->getEventHandler()->addEvent(EventHandler::CAPTURED, self::getEventCaptured($supervisor));
        $supervisor->getEventHandler()->addEvent(EventHandler::CAPTURED_RELEASED, self::getCapturedReleased($supervisor));
        $supervisor->getEventHandler()->addEvent(EventHandler::CAPTURED_CLEARED, self::getCapturedCleared($supervisor));

        // JsonObject from JSON Constructure.

        $supervisor->getEventHandler()->addEvent(JsonObject::COMPARING_CHILD, self::getComparingChild($supervisor));
        $supervisor->getEventHandler()->addEvent(JsonObject::CHILD_COMPARED, self::getChildCompared($supervisor));

        $supervisor->getEventHandler()->addEvent(JsonObject::MISSING_FIELD, self::getMissingField($supervisor));
        $supervisor->getEventHandler()->addEvent(JsonObject::UNEXPECTED_KEYS, self::getUnexpectedKeys($supervisor));
        $supervisor->getEventHandler()->addEvent(JsonObject::PLACEHOLDERS_FAILED, self::getPlaceholdersFailed($supervisor));

    }

    private static function getMissingField(ToolSupervisor $supervisor): callable
    {
        return function (string $key, JsonObject $expected, JsonObject $input) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage('Missing required field "' . $key . '"', new JsonContext($input)));
        };
    }

    private static function getUnexpectedKeys(ToolSupervisor $supervisor): callable
    {
        return function (array $unexpectedKeys, JsonObject $expected, JsonObject $input) use ($supervisor) {

            $messageLevel = ($expected->failsOnUnexpectedKeys() ? FeedbackMessages::ERROR : FeedbackMessages::WARNING);

            $supervisor->getFeedbackMessages()->addMessage($messageLevel, new FeedbackMessage('Unused keys were found: ' . implode(', ', $unexpectedKeys), new JsonContext($input)));
        };
    }

    private static function getPlaceholdersFailed(ToolSupervisor $supervisor): callable
    {
        return function (JsonObject $input, JsonObject $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage('Placeholders failed to validate', new JsonContext($input)));
        };
    }












    private static function getComparingChild(ToolSupervisor $supervisor): callable
    {
        return function (string $key,
             AbstractJsonStructure $inputChild,
             AbstractJsonStructure $expectedChild,
             AbstractJsonStructure $input,
             AbstractJsonStructure $expected) use ($supervisor)
        {
            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::DEBUG, new FeedbackMessage('Starting JSON field validation for field: ' . $key, new JsonContext($inputChild)));
        };
    }

    private static function getChildCompared(ToolSupervisor $supervisor): callable
    {
        return function (bool $result,
             string $key,
             AbstractJsonStructure $inputChild,
             AbstractJsonStructure $expectedChild,
             AbstractJsonStructure $input,
             AbstractJsonStructure $expected) use ($supervisor)
        {
            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::DEBUG, new FeedbackMessage('Finished JSON field validation for field: ' . $key, new JsonContext($inputChild)));
        };
    }

    private static function getEventCaptured(ToolSupervisor $supervisor): callable
    {
        return function (string $name, callable $event, array $inputs, EventHandler $eventHandler) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::DEBUG, new FeedbackMessage('Event captured', new GenericContext($name)));
        };
    }

    private static function getCapturedReleased(ToolSupervisor $supervisor): callable
    {
        return function (EventHandler $eventHandler, CapturedEvent ...$capturedEvents) use ($supervisor) {

            $names = array_map(function (CapturedEvent $capturedEvent) {

                return $capturedEvent->getName();
            }, $capturedEvents);


            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::DEBUG, new FeedbackMessage('Event capturing ended by releasing events', new GenericContext(...$names)));
        };
    }

    private static function getCapturedCleared(ToolSupervisor $supervisor): callable
    {
        return function (EventHandler $eventHandler, CapturedEvent ...$capturedEvents) use ($supervisor) {

            $names = array_map(function (CapturedEvent $capturedEvent) {

                return $capturedEvent->getName();
            }, $capturedEvents);


            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::DEBUG, new FeedbackMessage('Event capturing ended by clearing events', new GenericContext(...$names)));
        };
    }

    private static function getAuditsStart(ToolSupervisor $supervisor): callable
    {
        return function (StructureInterface $input, StructureInterface $expected, AuditInterface ...$audits) use ($supervisor) {

            $names = array_map(function (AuditInterface $audit) {

                return $audit->toString();
            }, $audits);

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::DEBUG, new FeedbackMessage('Starting audits', new GenericContext(...$names), new StructureContext($input)));
        };
    }

    private static function getAuditsComplete(ToolSupervisor $supervisor): callable
    {
        return function (array $failedAudits, StructureInterface $input, StructureInterface $expected, AuditInterface ...$audits) use ($supervisor) {

            $names = array_map(function (AuditInterface $audit) {

                return $audit->toString();
            }, $failedAudits);

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::DEBUG, new FeedbackMessage('Auditing complete', new GenericContext(...$names), new StructureContext($input)));
        };
    }

    private static function getAuditPredicatesStart(ToolSupervisor $supervisor): callable
    {
        return function (AuditInterface $audit, StructureInterface $input, StructureInterface $expected) use ($supervisor) {

            $names = array_map(function (AuditInterface $audit) {

                return $audit->toString();
            }, $audit->getPredicates());

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::DEBUG, new FeedbackMessage('Running predicates for audit', new AuditContext($audit), new GenericContext(...$names), new StructureContext($input)));
        };
    }

    private static function getAuditPredicatesComplete(ToolSupervisor $supervisor): callable
    {
        return function (AuditInterface $audit, StructureInterface $input, StructureInterface $expected, bool $passed) use ($supervisor) {

            $result = ($passed) ? 'proceed' : 'ignore';

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::DEBUG, new FeedbackMessage('Predicates complete, result: ' . $result, new AuditContext($audit), new StructureContext($input)));
        };
    }

    private static function getAuditsDeferredStart(ToolSupervisor $supervisor): callable
    {
        return function (StructureInterface $input, StructureInterface $expected, AuditInterface ...$audits) use ($supervisor) {

            $names = array_map(function (AuditInterface $audit) {

                return $audit->toString();
            }, $audits);

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::DEBUG, new FeedbackMessage('Running deferred audits', new GenericContext(...$names), new StructureContext($input)));
        };
    }

    private static function getAuditsDeferredEnd(ToolSupervisor $supervisor): callable
    {
        return function (StructureInterface $input, StructureInterface $expected, AuditInterface ...$audits) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::DEBUG, new FeedbackMessage('Deferred audits complete', new StructureContext($input)));
        };
    }

    private static function getAuditRunning(ToolSupervisor $supervisor): callable
    {
        return function (AuditInterface $audit, StructureInterface $input, StructureInterface $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::DEBUG, new FeedbackMessage('Running audit', new AuditContext($audit), new StructureContext($input)));
        };
    }

    private static function getAuditPassed(ToolSupervisor $supervisor): callable
    {
        return function (AuditInterface $audit, StructureInterface $input, StructureInterface $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::DEBUG, new FeedbackMessage('Audit passed', new AuditContext($audit), new StructureContext($input)));
        };
    }

    private static function getAuditFailed(ToolSupervisor $supervisor): callable
    {
        return function (AuditInterface $audit, StructureInterface $input, StructureInterface $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::DEBUG, new FeedbackMessage('Audit failed', new AuditContext($audit), new GenericContext($input->toString(), $expected->toString())));
        };
    }
}
