<?php namespace App\Domains\Minecraft\Tools\Outputs\Events;

use App\Domains\Minecraft\Tools\Outputs\Feedback\Context\AuditContext;
use App\Domains\Minecraft\Tools\Outputs\Feedback\Context\DeprecatedRegistryContext;
use App\Domains\Minecraft\Tools\Outputs\Feedback\Context\GenericContext;
use App\Domains\Minecraft\Tools\Outputs\Feedback\Context\JsonContext;
use App\Domains\Minecraft\Tools\Outputs\Feedback\Context\StructureContext;
use App\Domains\Minecraft\Tools\Outputs\Feedback\FeedbackMessage;
use App\Domains\Minecraft\Tools\Outputs\Feedback\FeedbackMessages;
use App\Domains\Minecraft\Tools\ToolSupervisor;
use Celestriode\Constructure\Context\AuditInterface;
use Celestriode\Constructure\Context\Audits\BitwiseAudits;
use Celestriode\Constructure\Structures\StructureInterface;
use Celestriode\JsonConstructure\Context\Audits\AbstractArrayAudit;
use Celestriode\JsonConstructure\Context\Audits\AbstractBooleanAudit;
use Celestriode\JsonConstructure\Context\Audits\AbstractNumericAudit;
use Celestriode\JsonConstructure\Context\Audits\AbstractObjectAudit;
use Celestriode\JsonConstructure\Context\Audits\AbstractParentAudit;
use Celestriode\JsonConstructure\Context\Audits\AbstractPrimitiveAudit;
use Celestriode\JsonConstructure\Context\Audits\AbstractStringAudit;
use Celestriode\JsonConstructure\Context\Audits\Branch;
use Celestriode\JsonConstructure\Context\Audits\ChildHasValue;
use Celestriode\JsonConstructure\Context\Audits\ExclusiveFields;
use Celestriode\JsonConstructure\Context\Audits\HasNElements;
use Celestriode\JsonConstructure\Context\Audits\HasValue;
use Celestriode\JsonConstructure\Context\Audits\InclusiveFields;
use Celestriode\JsonConstructure\Context\Audits\NumberRange;
use Celestriode\JsonConstructure\Context\Audits\SiblingHasValue;
use Celestriode\JsonConstructure\Context\Audits\TypesMatch;
use Celestriode\JsonConstructure\Structures\AbstractJsonStructure;
use Celestriode\JsonConstructure\Structures\Types\AbstractJsonParent;
use Celestriode\JsonConstructure\Structures\Types\AbstractJsonPrimitive;
use Celestriode\JsonConstructure\Structures\Types\JsonArray;
use Celestriode\JsonConstructure\Structures\Types\JsonObject;
use Celestriode\JsonConstructure\Structures\Types\JsonString;
use Celestriode\TargetSelectorConstructure\Context\Audits\HasValueFromResourceRegistry;
use Celestriode\TargetSelectorConstructure\Context\Audits\StringLength;

final class AuditEvents
{
    public static function populateEventHandler(ToolSupervisor $supervisor): void
    {
        // From Constructure.

        $supervisor->getEventHandler()->addEvent(BitwiseAudits::OR_FAILED, self::getBitwiseOrFailed($supervisor));
        $supervisor->getEventHandler()->addEvent(BitwiseAudits::XOR_MULTIPLE_PASS, self::getBitwiseXorMultiPass($supervisor));
        $supervisor->getEventHandler()->addEvent(BitwiseAudits::XOR_FAILED, self::getBitwiseXorFailed($supervisor));
        $supervisor->getEventHandler()->addEvent(BitwiseAudits::NOT_FAILED, self::getBitwiseNotFailed($supervisor));
        // TODO: BitwiseAudits::AND_FAILED

        // From JSON Constructure.

        $supervisor->getEventHandler()->addEvent(AbstractArrayAudit::INVALID_STRUCTURE, self::getArrayInvalidStructure($supervisor));
        $supervisor->getEventHandler()->addEvent(AbstractBooleanAudit::INVALID_STRUCTURE, self::getBooleanInvalidStructure($supervisor));
        $supervisor->getEventHandler()->addEvent(AbstractNumericAudit::INVALID_STRUCTURE, self::getNumericInvalidStructure($supervisor));
        $supervisor->getEventHandler()->addEvent(AbstractObjectAudit::INVALID_STRUCTURE, self::getObjectInvalidStructure($supervisor));
        $supervisor->getEventHandler()->addEvent(AbstractParentAudit::INVALID_STRUCTURE, self::getParentInvalidStructure($supervisor));
        $supervisor->getEventHandler()->addEvent(AbstractPrimitiveAudit::INVALID_STRUCTURE, self::getPrimitiveInvalidStructure($supervisor));
        $supervisor->getEventHandler()->addEvent(AbstractStringAudit::INVALID_STRUCTURE, self::getStringInvalidStructure($supervisor));

        $supervisor->getEventHandler()->addEvent(Branch::PASSED, self::getBranchPassed($supervisor));
        $supervisor->getEventHandler()->addEvent(ChildHasValue::INVALID_CHILD, self::getInvalidChildChildHasValue($supervisor));
        $supervisor->getEventHandler()->addEvent(ChildHasValue::INVALID_VALUE, self::getInvalidValueChildHasValue($supervisor));
        $supervisor->getEventHandler()->addEvent(ExclusiveFields::KEY_CONFLICT, self::getKeysConflictExclusiveFields($supervisor));
        $supervisor->getEventHandler()->addEvent(ExclusiveFields::NEEDS_ONE, self::getNeedsOneExclusiveFields($supervisor));
        $supervisor->getEventHandler()->addEvent(HasNElements::OUT_OF_RANGE, self::getOutOfRangeHasNElements($supervisor));
        $supervisor->getEventHandler()->addEvent(HasValue::INVALID_VALUE, self::getInvalidHasValue($supervisor));
        $supervisor->getEventHandler()->addEvent(InclusiveFields::MISSING_KEYS, self::getMissingKeysInclusiveFields($supervisor));
        $supervisor->getEventHandler()->addEvent(NumberRange::OUT_OF_RANGE, self::getOutOfRangeNumberRange($supervisor));
        $supervisor->getEventHandler()->addEvent(SiblingHasValue::NO_PARENT, self::getNoParentSiblingHasValue($supervisor));
        $supervisor->getEventHandler()->addEvent(SiblingHasValue::NO_SIBLING, self::getNoSiblingSiblingHasValue($supervisor));
        $supervisor->getEventHandler()->addEvent(TypesMatch::TYPES_MISMATCHED, self::getTypesMismatchedTypesMatch($supervisor));

        // TODO: StringLength
        // TODO: ValuesMatch

        // From TargetSelectorConstructure.

        $supervisor->getEventHandler()->addEvent(StringLength::INCOMPATIBLE, self::getTargetSelectorStringLengthIncompatible($supervisor));
        $supervisor->getEventHandler()->addEvent(StringLength::OUT_OF_RANGE, self::getTargetSelectorStringLengthOutOfRange($supervisor));
        $supervisor->getEventHandler()->addEvent(HasValueFromResourceRegistry::INVALID_VALUE_LENIENT, self::getTargetSelectorHasValueInvalidValueLenient($supervisor));
    }

    private static function getTargetSelectorHasValueInvalidValueLenient(ToolSupervisor $supervisor): callable
    {
        return function (HasValueFromResourceRegistry $audit, StructureInterface $input, StructureInterface $expected, $value) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::WARNING, new FeedbackMessage('Unknown resource location: ' . (string)$value, new AuditContext($audit), new GenericContext($input->toString()), new DeprecatedRegistryContext($audit->getTagRegistry())));
        };
    }

    private static function getTargetSelectorStringLengthIncompatible(ToolSupervisor $supervisor): callable
    {
        return function (StringLength $audit, StructureInterface $input, StructureInterface $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage('Unable to determine string length for input.', new AuditContext($audit), new GenericContext($input->toString())));
        };
    }

    private static function getTargetSelectorStringLengthOutOfRange(ToolSupervisor $supervisor): callable
    {
        return function (float $len, StringLength $audit, StructureInterface $input, StructureInterface $expected) use ($supervisor) {

            $lead = 'Character length of';

            if ($audit->getBounds()->getMin() === null) {

                $msg = 'less than ' . $audit->getBounds()->getMax() . ' (' . (!$audit->isInclusive() ? 'exclusive' : 'inclusive') . ')';
            } else if ($audit->getBounds()->getMax() === null) {

                $msg = 'more than ' . $audit->getBounds()->getMin() . ' (' . (!$audit->isInclusive() ? 'exclusive' : 'inclusive') . ')';
            } else {

                $msg = 'between ' . $audit->getBounds()->getMin() . ' and ' . $audit->getBounds()->getMax() . ' (' . (!$audit->isInclusive() ? 'exclusive' : 'inclusive') . ')';
            }

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage($lead . ' ' . $len . ' is out of range, must be ' . $msg, new AuditContext($audit), new GenericContext($input->toString())));
        };
    }

    private static function getOutOfRangeHasNElements(ToolSupervisor $supervisor): callable
    {
        return function (int $count, HasNElements $audit, AbstractJsonParent $input, AbstractJsonParent $expected) use ($supervisor) {

            if ($audit->getMax() === null) {

                $submsg = 'at least ' . $audit->getMin();
            } else if ($audit->getMin() === null) {

                $submsg = 'at most ' . $audit->getMax();
            } else {

                $submsg = 'between ' . $audit->getMin() . ' and ' . $audit->getMax();
            }

            if ($input instanceof JsonObject) {

                $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage(
                    'Incorrect number of fields, must be ' . $submsg . ' (' . ($audit->isInclusive() ? 'inclusive' : 'exclusive') . ')',
                    new AuditContext($audit), new JsonContext($input)));
            } else if ($input instanceof JsonArray) {

                $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage(
                    'Incorrect number of elements, must be ' . $submsg . ' (' . ($audit->isInclusive() ? 'inclusive' : 'exclusive') . ')',
                    new AuditContext($audit), new JsonContext($input)));
            }
        };
    }

    private static function getBranchPassed(ToolSupervisor $supervisor): callable
    {
        return function (Branch $audit, AbstractJsonStructure $input, AbstractJsonStructure $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::DEBUG, new FeedbackMessage('Branch passed: ' . $audit->getBranchName(), new AuditContext($audit), new JsonContext($input)));
        };
    }

    private static function getInvalidChildChildHasValue(ToolSupervisor $supervisor): callable
    {
        return function (ChildHasValue $audit, AbstractJsonStructure $input, AbstractJsonStructure $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::DEBUG, new FeedbackMessage('Missing expected field "' . $audit->getKey() . '"', new AuditContext($audit), new JsonContext($input)));
        };
    }

    private static function getInvalidValueChildHasValue(ToolSupervisor $supervisor): callable
    {
        return function (ChildHasValue $audit, JsonObject $input, JsonObject $expected) use ($supervisor) {

            /**
             * @var AbstractJsonPrimitive $child
             */
            $child = $input->getChild($audit->getKey());

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage('Invalid value "' . $child->getString() . '" for field "' . $audit->getKey() . '". Must be one of: ' . implode(', ', $audit->getValues()), new AuditContext($audit), new JsonContext($child)));
        };
    }

    private static function getKeysConflictExclusiveFields(ToolSupervisor $supervisor): callable
    {
        return function (array $matchedKeys, ExclusiveFields $audit, JsonObject $input, JsonObject $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage('Object contains conflicting fields: ' . implode(', ', $matchedKeys) . '. Must be only one of: ' . implode(', ', $audit->getExclusiveKeys()), new AuditContext($audit), new JsonContext($input)));
        };
    }

    private static function getNeedsOneExclusiveFields(ToolSupervisor $supervisor): callable
    {
        return function (ExclusiveFields $audit, JsonObject $input, JsonObject $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage('One of the following fields is required: ' . implode(', ', $audit->getExclusiveKeys()), new AuditContext($audit), new JsonContext($input)));
        };
    }

    private static function getInvalidHasValue(ToolSupervisor $supervisor): callable
    {
        return function (HasValue $audit, AbstractJsonPrimitive $input, AbstractJsonPrimitive $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage('Invalid value "' . $input->getString() . '", but must one of: ' . implode(', ', $audit->getValues()), new AuditContext($audit), new JsonContext($input)));
        };
    }

    private static function getMissingKeysInclusiveFields(ToolSupervisor $supervisor): callable
    {
        return function (array $missingKeys, InclusiveFields $audit, JsonObject $input, JsonObject $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage('JSON object is missing required keys. Has: ' . implode(', ', $input->getKeys()) . '. Requires all of the following keys: ' . implode(', ', $audit->getKeys()), new AuditContext($audit), new JsonContext($input)));
        };
    }

    private static function getOutOfRangeNumberRange(ToolSupervisor $supervisor): callable
    {
        return function (NumberRange $audit, AbstractJsonPrimitive $input, AbstractJsonPrimitive $expected) use ($supervisor) {

            if ($input instanceof JsonString) {

                $lead = 'Character length of';
            } else {

                $lead = 'Value of';
            }

            if ($audit->getMin() === null) {

                $msg = 'less than ' . $audit->getMax() . ' (' . ($audit->isExclusive() ? 'exclusive' : 'inclusive') . ')';
            } else if ($audit->getMax() === null) {

                $msg = 'more than ' . $audit->getMin() . ' (' . ($audit->isExclusive() ? 'exclusive' : 'inclusive') . ')';
            } else {

                $msg = 'between ' . $audit->getMin() . ' and ' . $audit->getMax();
            }

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage($lead . ' ' . $input->getDouble() . ' is out of range, must be ' . $msg, new AuditContext($audit), new JsonContext($input)));
        };
    }

    private static function getNoParentSiblingHasValue(ToolSupervisor $supervisor): callable
    {
        return function (SiblingHasValue $audit, AbstractJsonStructure $input, AbstractJsonStructure $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage('Could not locate a sibling field called "' . $audit->getKey() . '" because a parent structure does not exist in this context', new AuditContext($audit), new JsonContext($input)));
        };
    }

    private static function getNoSiblingSiblingHasValue(ToolSupervisor $supervisor): callable
    {
        return function (SiblingHasValue $audit, AbstractJsonStructure $input, AbstractJsonStructure $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage('Could not find sibling "' . $audit->getKey() . '" for field "' . $input->getKey() . '"', new AuditContext($audit), new JsonContext($input->getParent())));
        };
    }

    private static function getTypesMismatchedTypesMatch(ToolSupervisor $supervisor): callable
    {
        return function (TypesMatch $audit, AbstractJsonStructure $input, AbstractJsonStructure $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage('Incorrect data type. Was ' . $input->getTypeName() . ', must be: ' . $expected->getTypeName(), new AuditContext($audit), new JsonContext($input)));
        };
    }





































    private static function getArrayInvalidStructure(ToolSupervisor $supervisor): callable
    {
        return function (AbstractArrayAudit $audit, AbstractJsonStructure $input, AbstractJsonStructure $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::DEBUG, new FeedbackMessage('JSON type must be an array, was: ' . $input->getTypeName(), new AuditContext($audit), new JsonContext($input)));
        };
    }

    private static function getBooleanInvalidStructure(ToolSupervisor $supervisor): callable
    {
        return function (AbstractBooleanAudit $audit, AbstractJsonStructure $input, AbstractJsonStructure $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::DEBUG, new FeedbackMessage('JSON type must be a boolean, was: ' . $input->getTypeName(), new AuditContext($audit), new JsonContext($input)));
        };
    }

    private static function getNumericInvalidStructure(ToolSupervisor $supervisor): callable
    {
        return function (AbstractNumericAudit $audit, AbstractJsonStructure $input, AbstractJsonStructure $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::DEBUG, new FeedbackMessage('JSON type must be an integer or double, was: ' . $input->getTypeName(), new AuditContext($audit), new JsonContext($input)));
        };
    }

    private static function getObjectInvalidStructure(ToolSupervisor $supervisor): callable
    {
        return function (AbstractObjectAudit $audit, AbstractJsonStructure $input, AbstractJsonStructure $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::DEBUG, new FeedbackMessage('JSON type must be an object, was: ' . $input->getTypeName(), new AuditContext($audit), new JsonContext($input)));
        };
    }

    private static function getParentInvalidStructure(ToolSupervisor $supervisor): callable
    {
        return function (AbstractParentAudit $audit, AbstractJsonStructure $input, AbstractJsonStructure $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::DEBUG, new FeedbackMessage('JSON type must be an object or array, was: ' . $input->getTypeName(), new AuditContext($audit), new JsonContext($input)));
        };
    }

    private static function getPrimitiveInvalidStructure(ToolSupervisor $supervisor): callable
    {
        return function (AbstractPrimitiveAudit $audit, AbstractJsonStructure $input, AbstractJsonStructure $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::DEBUG, new FeedbackMessage('JSON type must be a boolean, integer, double, or string, was: ' . $input->getTypeName(), new AuditContext($audit), new JsonContext($input)));
        };
    }

    private static function getStringInvalidStructure(ToolSupervisor $supervisor): callable
    {
        return function (AbstractStringAudit $audit, AbstractJsonStructure $input, AbstractJsonStructure $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::DEBUG, new FeedbackMessage('JSON type must be a string, was: ' . $input->getTypeName(), new AuditContext($audit), new JsonContext($input)));
        };
    }

    private static function getBitwiseOrFailed(ToolSupervisor $supervisor): callable
    {
        return function (array $capturedEvents, BitwiseAudits $audit, StructureInterface $input, StructureInterface $expected) use ($supervisor) {

            $names = array_map(function (AuditInterface $nestedAudit) {

                return $nestedAudit->toString();
            }, $audit->getAudits());

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage('Bitwise OR failed, at least one of the following audits must pass: ' . implode(', ', $names), new AuditContext($audit), new StructureContext($input)));
           // $eventMessages->addMessageWithContext(FeedbackMessages::ERROR, 'Bitwise OR failed, at least one of the following audits must pass: ' . implode(', ', $names), $input);
        };
    }

    private static function getBitwiseXorMultiPass(ToolSupervisor $supervisor): callable
    {
        return function (AuditInterface $passedAudit,
             array $passedAuditEvents,
             AuditInterface $secondPassedAudit,
             array $capturedSecondaryEvents,
             BitwiseAudits $audit,
             StructureInterface $input,
             StructureInterface $expected) use ($supervisor)
        {
            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage('Bitwise XOR failed, multiple audits passed: ' . $passedAudit::getName() . ' and ' . $secondPassedAudit::getName(), new AuditContext($audit), new StructureContext($input)));
        };
    }

    private static function getBitwiseXorFailed(ToolSupervisor $supervisor): callable
    {
        return function (BitwiseAudits $audit, StructureInterface $input, StructureInterface $expected) use ($supervisor) {

            $names = array_map(function (AuditInterface $nestedAudit) {

                return $nestedAudit::getName();
            }, $audit->getAudits());

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage('Bitwise XOR failed, one of the following audits must pass: ' . implode(', ', $names), new AuditContext($audit), new StructureContext($input)));
        };
    }

    private static function getBitwiseNotFailed(ToolSupervisor $supervisor): callable
    {
        return function (AuditInterface $passedAudit, array $capturedEvents, BitwiseAudits $audit, StructureInterface $input, StructureInterface $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage('Bitwise NOT failed, the following audit incorrectly passed: ' . $passedAudit::getName(), new AuditContext($audit), new StructureContext($input)));
        };
    }
}
