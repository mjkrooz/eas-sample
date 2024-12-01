<?php namespace App\Domains\Minecraft\Registries\Populators;

use Cache;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Celestriode\DynamicRegistry\AbstractRegistry;
use Celestriode\DynamicRegistry\DynamicPopulatorInterface;
use Celestriode\DynamicRegistry\Exception\InvalidValue;
use ErrorException;
use RuntimeException;
use Log;

/**
 * A dynamic dynamic populator. Populates from Arcensoth's MCData repository. This can be created multiple times with
 * different URIs for different registries.
 *
 * https://raw.githubusercontent.com/Arcensoth/mcdata/master/processed
 *
 * @package App\Domains\Minecraft\Registries\Populators
 */
class ArcMcDataPopulator implements DynamicPopulatorInterface
{
    public const TYPE_REGISTRY = 1;
    public const TYPE_TAG = 2;

    private const PREFIX =   'arc_mcdata:';
    private const REGISTRY = 'https://raw.githubusercontent.com/Arcensoth/mcdata/master/processed/reports/registries/';
    private const TAG =      'https://raw.githubusercontent.com/Arcensoth/mcdata/master/processed/data/minecraft/tags/';
    private const CACHE_TIME = 60; // TODO: 3600
    private string $registry;
    private int $type;

    public function __construct(string $registry, int $type = self::TYPE_REGISTRY)
    {
        $this->registry = $registry;
        $this->type = $type;
    }

    public function getType(): int
    {
        return $this->type;
    }

    /**
     * Returns the full path to the target registry within Arc's repo.
     *
     * @return string
     */
    final public function getUri(): string
    {
        switch ($this->getType()) {

            case self::TYPE_REGISTRY:
                return self::REGISTRY . $this->getRegistry() . '/data.min.json';
            case self::TYPE_TAG:
                return self::TAG . $this->getRegistry() . '/data.min.json';
        }

        throw new RuntimeException('Unknown arcmdata type');
    }

    /**
     * Returns the registry name for this instance of populator.
     *
     * @return string
     */
    public function getRegistry(): string
    {
        return $this->registry;
    }

    /**
     * Builds and returns the appropriate cache key.
     *
     * @return string
     */
    public function getCacheKey(): string
    {
        return self::PREFIX . $this->type . $this->getRegistry();
    }

    /**
     * Creates a new instance of an ArcMcDataPopulator.
     *
     * @param string $uri
     * @param int $type
     * @return static
     */
    public static function make(string $uri, int $type = self::TYPE_REGISTRY): self
    {
        return new static($uri, $type);
    }

    /**
     * @inheritDoc
     * @throws InvalidValue
     */
    public function populate(AbstractRegistry $registry): void
    {
        $json = json_decode(Cache::get($this->getCacheKey()));
        \Debugbar::startMeasure('arcmcdata_lookup', 'arcmcdata_lookup');

        // If the data existed in the cache, populate with it.

        try {

            if ($json !== null && Carbon::fromSerialized($json->time)->diffInSeconds(Carbon::now()) < self::CACHE_TIME) {

                $registry->addValues(...($json->data));

                \Debugbar::stopMeasure('arcmcdata_lookup');
                return;
            }
        } catch (InvalidFormatException $e) {

            $json->time = null;
        }

        // Otherwise, get the data, cache it, and populate.

        try {

            $raw = file_get_contents($this->getUri());
            $json = json_decode($raw);
            $data = [
                'time' => Carbon::now()->serialize(),
                'data' => []
            ];

            // While ensuring the expected structure is correct...

            if ($json !== null && isset($json->values) && is_array($json->values)) {

                // Cycle through each of the values.

                foreach ($json->values as $value) {

                    // If the value is a string, add it to the registry and set it aside for caching.

                    if (is_string($value)) {

                        $registry->addValue($value);
                        $data['data'][] = $value;
                    }
                }
            }

            // All set, cache the result for an hour. TODO: how could I not lose cache if arc/mcdata is unreachable?

            Cache::forever($this->getCacheKey(), json_encode($data));
        } catch (ErrorException $e) {

            // Fail with log. Persist current cache for slightly longer.

            if ($json !== null) {

                $json->time = Carbon::now()->serialize();
                $registry->addValues(...($json->data));

                Cache::forever($this->getCacheKey(), json_encode($json));
            }

            Log::error('Arcensoth\'s mdata repo was unreachable. Reusing old cache, if it exists.');
        }
        \Debugbar::stopMeasure('arcmcdata_lookup');
    }
}
