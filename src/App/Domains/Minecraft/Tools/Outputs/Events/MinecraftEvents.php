<?php namespace App\Domains\Minecraft\Tools\Outputs\Events;

use App\Domains\Minecraft\Tools\Outputs\Feedback\Context\AuditContext;
use App\Domains\Minecraft\Tools\Outputs\Feedback\Context\DeprecatedRegistryContext;
use App\Domains\Minecraft\Tools\Outputs\Feedback\Context\JsonContext;
use App\Domains\Minecraft\Tools\Outputs\Feedback\Context\ResourceLocationContext;
use App\Domains\Minecraft\Tools\Outputs\Feedback\FeedbackMessage;
use App\Domains\Minecraft\Tools\Outputs\Feedback\FeedbackMessages;
use App\Domains\Minecraft\Tools\ToolSupervisor;
use Celestriode\Captain\Exceptions\CommandSyntaxException;
use Celestriode\ConstructuresMinecraft\Audits\General\CoordinateSetTrait;
use Celestriode\ConstructuresMinecraft\Audits\Json\ChildHasResource;
use Celestriode\ConstructuresMinecraft\Audits\Json\CoordinateSet;
use Celestriode\ConstructuresMinecraft\Audits\Json\HasResourceFromRegistry;
use Celestriode\ConstructuresMinecraft\Audits\Json\HasValueFromRegistry;
use Celestriode\ConstructuresMinecraft\Audits\Json\IsInteger;
use Celestriode\ConstructuresMinecraft\Audits\Json\IsResourceLocation;
use Celestriode\ConstructuresMinecraft\Audits\Json\ValidColor;
use Celestriode\ConstructuresMinecraft\Audits\Json\ValidFile;
use Celestriode\ConstructuresMinecraft\Audits\Json\ValidNbtPath;
use Celestriode\ConstructuresMinecraft\Audits\Json\ValidSelector;
use Celestriode\ConstructuresMinecraft\Audits\Json\ValidSnbt;
use Celestriode\ConstructuresMinecraft\Audits\Json\ValidUrl;
use Celestriode\ConstructuresMinecraft\Audits\Json\ValidUuid;
use Celestriode\ConstructuresMinecraft\Utils\ResourceLocation;
use Celestriode\DynamicMinecraftRegistries\Java\Game\Colors;
use Celestriode\JsonConstructure\Structures\Types\AbstractJsonPrimitive;
use Celestriode\JsonConstructure\Structures\Types\JsonObject;
use Celestriode\JsonConstructure\Structures\Types\JsonString;
use Celestriode\Mattock\Exceptions\NotInRegistryException;
use Exception;

final class MinecraftEvents
{
    public static function populateEventHandler(ToolSupervisor $supervisor): void
    {
        $supervisor->getEventHandler()->addEvent(ChildHasResource::INVALID_SYNTAX, self::getInvalidSyntaxChildHasResource($supervisor));
        $supervisor->getEventHandler()->addEvent(ChildHasResource::INVALID_RESOURCE, self::getInvalidResourceChildHasResource($supervisor));

        $supervisor->getEventHandler()->addEvent(CoordinateSetTrait::$WRONG_COORDINATE_COUNT, self::getWrongCoordinateCountCoordinateSet($supervisor));
        $supervisor->getEventHandler()->addEvent(CoordinateSetTrait::$INVALID_COORDINATES, self::getInvalidCoordinatesCoordinateSet($supervisor));
        $supervisor->getEventHandler()->addEvent(CoordinateSetTrait::$MIXED_LOCAL, self::getMixedLocalCoordinateSet($supervisor));

        $supervisor->getEventHandler()->addEvent(HasResourceFromRegistry::INVALID_SYNTAX, self::getInvalidSyntaxHasResourceFromRegistry($supervisor));
        $supervisor->getEventHandler()->addEvent(HasResourceFromRegistry::INVALID_RESOURCE, self::getInvalidResourceHasResourceFromRegistry($supervisor));
        $supervisor->getEventHandler()->addEvent(HasResourceFromRegistry::CUSTOM_RESOURCE, self::getCustomResourceHasResourceFromRegistry($supervisor));

        $supervisor->getEventHandler()->addEvent(HasValueFromRegistry::INVALID_VALUE, self::getInvalidValueHasValueFromRegistry($supervisor));
        $supervisor->getEventHandler()->addEvent(HasValueFromRegistry::CUSTOM_VALUE, self::getCustomValueHasValueFromRegistry($supervisor));

        $supervisor->getEventHandler()->addEvent(IsInteger::INVALID_VALUE, self::getInvalidValueIsInteger($supervisor));

        $supervisor->getEventHandler()->addEvent(IsResourceLocation::INVALID_SYNTAX, self::getInvalidSyntaxIsResourceLocation($supervisor));

        $supervisor->getEventHandler()->addEvent(ValidColor::INVALID_INTEGER, self::getInvalidIntegerValidColor($supervisor));
        $supervisor->getEventHandler()->addEvent(ValidColor::INVALID_HEX, self::getInvalidHexValidColor($supervisor));
        $supervisor->getEventHandler()->addEvent(ValidColor::INVALID_PREFIX, self::getInvalidPrefixValidColor($supervisor));
        $supervisor->getEventHandler()->addEvent(ValidColor::INVALID_COLOR, self::getInvalidColorValidColor($supervisor));

        $supervisor->getEventHandler()->addEvent(ValidFile::NO_USAGE, self::getNoUsageValidFile($supervisor));

        $supervisor->getEventHandler()->addEvent(ValidNbtPath::INVALID_SYNTAX, self::getInvalidSyntaxValidNbtPath($supervisor));

        $supervisor->getEventHandler()->addEvent(ValidSelector::INVALID_SYNTAX, self::getInvalidSyntaxValidSelector($supervisor));

        $supervisor->getEventHandler()->addEvent(ValidSnbt::INVALID_SYNTAX, self::getInvalidSyntaxValidSnbt($supervisor));

        $supervisor->getEventHandler()->addEvent(ValidUrl::INVALID_PROTOCOL, self::getInvalidProtocolValidUrl($supervisor));
        $supervisor->getEventHandler()->addEvent(ValidUrl::INVALID_SYNTAX, self::getInvalidSyntaxValidUrl($supervisor));

        $supervisor->getEventHandler()->addEvent(ValidUuid::INVALID_SYNTAX, self::getInvalidSyntaxValidUuid($supervisor));
    }

    private static function getInvalidSyntaxValidSnbt(ToolSupervisor $supervisor): callable
    {
        return function (Exception $e, ValidSnbt $audit, JsonString $input, JsonString $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage('Invalid SNBT syntax: ' . $e->getMessage(), new AuditContext($audit), new JsonContext($input)));
        };
    }

    private static function getInvalidProtocolValidUrl(ToolSupervisor $supervisor): callable
    {
        return function (ValidUrl $audit, JsonString $input, JsonString $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage('Invalid protocol in URL. Must be either "http" or "https"', new AuditContext($audit), new JsonContext($input)));
        };
    }

    private static function getInvalidSyntaxValidUrl(ToolSupervisor $supervisor): callable
    {
        return function (ValidUrl $audit, JsonString $input, JsonString $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage('Invalid URL syntax', new AuditContext($audit), new JsonContext($input)));
        };
    }

    private static function getInvalidSyntaxValidUuid(ToolSupervisor $supervisor): callable
    {
        return function (ValidUuid $audit, JsonString $input, JsonString $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage('Invalid UUID syntax', new AuditContext($audit), new JsonContext($input)));
        };
    }

    private static function getInvalidSyntaxValidSelector(ToolSupervisor $supervisor): callable
    {
        return function (Exception $e, ValidSelector $audit, JsonString $input, JsonString $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage('Invalid selector syntax: ' . $e->getMessage(), new AuditContext($audit), new JsonContext($input)));
        };
    }

    private static function getInvalidSubvalueValidSelector(ToolSupervisor $supervisor): callable
    {
        return function (CommandSyntaxException $e, NotInRegistryException $e2, ValidSelector $audit, JsonString $input, JsonString $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::WARNING, new FeedbackMessage($e->getMessage(), new AuditContext($audit), new JsonContext($input), new DeprecatedRegistryContext($e2->getRegistry())));
        };
    }

    private static function getInvalidSyntaxValidNbtPath(ToolSupervisor $supervisor): callable
    {
        return function (Exception $e, ValidNbtPath $audit, JsonString $input, JsonString $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage('Invalid NBT path syntax: ' . $e->getMessage(), new AuditContext($audit), new JsonContext($input)));
        };
    }

    private static function getNoUsageValidFile(ToolSupervisor $supervisor): callable
    {
        return function (ValidFile $audit, JsonString $input, JsonString $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage('Cannot use "open_file" in vanilla.', new AuditContext($audit), new JsonContext($input)));
        };
    }

    private static function getInvalidIntegerValidColor(ToolSupervisor $supervisor): callable
    {
        return function (ValidColor $audit, AbstractJsonPrimitive $input, AbstractJsonPrimitive $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage('Invalid integer color "' . $input->getString() . '", must be a number between 0 and 16777215.', new AuditContext($audit), new JsonContext($input)));
        };
    }

    private static function getInvalidHexValidColor(ToolSupervisor $supervisor): callable
    {
        return function (ValidColor $audit, AbstractJsonPrimitive $input, AbstractJsonPrimitive $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage('Invalid hex color "' . $input->getString() . '", must be a hex value between 000000 and FFFFFF.', new AuditContext($audit), new JsonContext($input)));
        };
    }

    private static function getInvalidPrefixValidColor(ToolSupervisor $supervisor): callable
    {
        return function (ValidColor $audit, AbstractJsonPrimitive $input, AbstractJsonPrimitive $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage('Invalid hex prefix "' . substr($input->getString(), 0, 1) . '", must start with: ' . ValidColor::PREFIX, new AuditContext($audit), new JsonContext($input)));
        };
    }

    private static function getInvalidColorValidColor(ToolSupervisor $supervisor): callable
    {
        return function (ValidColor $audit, AbstractJsonPrimitive $input, AbstractJsonPrimitive $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage('Invalid color name "' . $input->getString() . '", must be one of: ' . implode(', ', Colors::get()->getValues()), new JsonContext($input), new AuditContext($audit), new DeprecatedRegistryContext(Colors::get())));
        };
    }

    private static function getInvalidSyntaxIsResourceLocation(ToolSupervisor $supervisor): callable
    {
        return function (CommandSyntaxException $e, IsResourceLocation $audit, JsonString $input, JsonString $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage('Syntax error with resource location "' . $input->getString() . '": ' . $e->getMessage(), new AuditContext($audit), new JsonContext($input), new ResourceLocationContext()));
        };
    }

    private static function getInvalidValueIsInteger(ToolSupervisor $supervisor): callable
    {
        return function (IsInteger $audit, AbstractJsonPrimitive $input, AbstractJsonPrimitive $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage('Invalid integer "' . $input->getString() . '"', new AuditContext($audit), new JsonContext($input)));
        };
    }

    private static function getInvalidValueHasValueFromRegistry(ToolSupervisor $supervisor): callable
    {
        return function (HasValueFromRegistry $audit, AbstractJsonPrimitive $input, AbstractJsonPrimitive $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage('Invalid value "' . $input->getString() . '"', new AuditContext($audit), new JsonContext($input), new DeprecatedRegistryContext($audit->getRegistry())));
        };
    }

    private static function getCustomValueHasValueFromRegistry(ToolSupervisor $supervisor): callable
    {
        return function (HasValueFromRegistry $audit, AbstractJsonPrimitive $input, AbstractJsonPrimitive $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::WARNING, new FeedbackMessage('Custom value "' . $input->getString() . '" could not be verified', new AuditContext($audit), new JsonContext($input), new DeprecatedRegistryContext($audit->getRegistry())));
        };
    }

    private static function getInvalidSyntaxChildHasResource(ToolSupervisor $supervisor): callable
    {
        return function (CommandSyntaxException $e, ChildHasResource $audit, JsonObject $input, JsonObject $expected) use ($supervisor) {

            /** @var JsonString $child */

            $child = $input->getChild($audit->getKey());

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage('Syntax error with resource location "' . $child->getString() . '": ' . $e->getMessage(), new AuditContext($audit), new JsonContext($input), new ResourceLocationContext()));
        };
    }

    private static function getInvalidResourceChildHasResource(ToolSupervisor $supervisor): callable
    {
        return function (ResourceLocation $resource, ChildHasResource $audit, JsonObject $input, JsonObject $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage('Invalid resource location "' . $resource->toString() . '"', new AuditContext($audit), new DeprecatedRegistryContext($audit->getRegistry()), new JsonContext($input), new ResourceLocationContext()));
        };
    }

    private static function getWrongCoordinateCountCoordinateSet(ToolSupervisor $supervisor): callable
    {
        return function (array $axes, CoordinateSet $audit, JsonString $input, JsonString $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage('Incorrect number of coordinates specified; was ' . count($axes) . ', must be ' . $audit->getCoordinateCount(), new AuditContext($audit), new JsonContext($input)));
        };
    }

    private static function getInvalidCoordinatesCoordinateSet(ToolSupervisor $supervisor): callable
    {
        return function (array $wrongAxes, array $axes, CoordinateSet $audit, JsonString $input, JsonString $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage('Invalid coordinate value(s): ' . implode(', ', $wrongAxes), new JsonContext($input), new AuditContext($audit)));
        };
    }

    private static function getMixedLocalCoordinateSet(ToolSupervisor $supervisor): callable
    {
        return function (array $axes, CoordinateSet $audit, JsonString $input, JsonString $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage('Cannot mix local coordinates (^) with other types of coordinates (~ or absolute coordinates)', new AuditContext($audit), new JsonContext($input)));
        };
    }

    private static function getInvalidSyntaxHasResourceFromRegistry(ToolSupervisor $supervisor): callable
    {
        return function (CommandSyntaxException $e, HasResourceFromRegistry $audit, AbstractJsonPrimitive $input, AbstractJsonPrimitive $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage('Syntax error with resource location "' . $input->getString() . '": ' . $e->getMessage(), new AuditContext($audit), new JsonContext($input), new ResourceLocationContext()));
        };
    }

    private static function getInvalidResourceHasResourceFromRegistry(ToolSupervisor $supervisor): callable
    {
        return function (ResourceLocation $resource, HasResourceFromRegistry $audit, AbstractJsonPrimitive $input, AbstractJsonPrimitive $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::ERROR, new FeedbackMessage('Invalid resource location "' . $resource->toString() . '"', new AuditContext($audit), new DeprecatedRegistryContext($audit->getRegistry()), new JsonContext($input), new ResourceLocationContext()));
        };
    }

    private static function getCustomResourceHasResourceFromRegistry(ToolSupervisor $supervisor): callable
    {
        return function (ResourceLocation $resource, HasResourceFromRegistry $audit, AbstractJsonPrimitive $input, AbstractJsonPrimitive $expected) use ($supervisor) {

            $supervisor->getFeedbackMessages()->addMessage(FeedbackMessages::WARNING, new FeedbackMessage('Custom resource location "' . $resource->toString() . '" could not be verified', new AuditContext($audit), new JsonContext($input), new ResourceLocationContext()));
        };
    }
}
