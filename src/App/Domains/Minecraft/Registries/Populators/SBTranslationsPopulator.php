<?php namespace App\Domains\Minecraft\Registries\Populators;

use Celestriode\DynamicRegistry\AbstractRegistry;
use Celestriode\DynamicRegistry\DynamicPopulatorInterface;
use Celestriode\DynamicRegistry\Exception\InvalidValue;

/**
 * Temporary holding for translations until TODO: databases are added.
 *
 * @package Celestriode\ConstructuresMinecraft\Utils\Populators
 */
class SBTranslationsPopulator implements DynamicPopulatorInterface
{
    /**
     * @inheritDoc
     * @throws InvalidValue
     */
    public function populate(AbstractRegistry $registry): void
    {
        \Debugbar::startMeasure('decoding', 'Decoding raw translations time');
        $data = json_decode(file_get_contents(__DIR__ . '/../../../../Data/java_translation_keys.json'));

        \Debugbar::stopMeasure('decoding');
        \Debugbar::startMeasure('adding', 'Adding decoded translations time');
        $registry->addValues(...$data);
        \Debugbar::stopMeasure('adding');
    }
}
