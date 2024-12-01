<h2 class="text-monospace" id="sec-cured-zombie-villager"><span class="text-muted">minecraft:</span>cured_zombie_villager</h2>
<p>This triggers whenever a zombie villager completes its conversion into a villager. The player that had cured it will be the one fulfilling the trigger.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\CuredZombieVillager::class, 'main')])

<p>There are 3 conditions for this trigger: <code><a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}#sec-player-condition">player</a></code>, <code>zombie</code>, <code>villager</code>.</p>

<h3 class="text-monospace" id="sec-zombie">zombie</h3>
<hr>

<p>The <code>zombie</code> object uses the {{ guide_link(DataSchemas\Entity::class, 0) }} to check entity data of the zombie that was converted.</p>

<p>The origin for the distance range for the entity will be the zombie's location. That is, the value will describe the distance between the cured zombie and the player. The following checks if the player cured a zombie but was 50+ blocks away from it when the conversion was completed.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\CuredZombieVillager::class, 'zombie', $example_data)])

<h3 class="text-monospace" id="sec-villager">villager</h3>
<hr>

<p>The <code>villager</code> object uses the {{ guide_link(DataSchemas\Entity::class, 1) }} to check entity data for the villager that was created as a result of converting.</p>

<p>The origin for the distance range for the entity will be the villager's location. That is, the value will describe the distance between the new villager and the player. The following checks if the player cured a zombie but was 50+ blocks away from it when the conversion was completed.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\CuredZombieVillager::class, 'villager', $example_data)])

@include('sourceblock::utils.data-schema-modals', [
    'modal_title' => trans('sourceblock::App/titles.minecraft.data-schemas.meta.modal-title'),
    'modal_data_schemas' => [
        [
            'schema' => DataSchemas\Entity::class,
            'path' => 'criteria.custom_test_name.conditions.zombie'
        ],
        [
            'schema' => DataSchemas\Entity::class,
            'path' => 'criteria.custom_test_name.conditions.villager'
        ]
    ]
])
