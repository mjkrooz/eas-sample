<h2 class="text-monospace" id="sec-killed-by-crossbow"><span class="text-muted">minecraft:</span>killed_by_crossbow</h2>
<p>This triggers whenever the player kills a mob with a projectile shot from a crossbow.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\KilledByCrossbow::class, 'main')])

<p>There are 3 conditions for this trigger: <code><a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}#sec-player-condition">player</a></code>, <code>victims</code>, <code>unique_entity_types</code>.</p>

<h3 class="text-monospace" id="sec-victims">victims</h3>
<hr>

<p>The <code>victims</code> list contains objects that use the {{ guide_link(DataSchemas\Entity::class, 0) }} to detail the type of entities that must be killed by a single projectile (requiring a Piercing enchantment in order to specify more than one victim). For example, the following only succeeds if the player killed a creeper with a crossbow.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\KilledByCrossbow::class, 'victims1', $example_data)])

<p>If multiple entities are specified, the projectile must kill all of the specified entities. For example, the following will succeed if both a creeper and a zombie were killed by the same crossbow projectile, but will fail if only one or the other were struck. This requires the use of the Piercing enchantment.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\KilledByCrossbow::class, 'victims2', $example_data)])

<p>If the same entity is specified multiple times, then the projectile must kill as many of that entity as is specified. For example, the following will only succeed if the projectile killed 2 individual creepers.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\KilledByCrossbow::class, 'victims3', $example_data)])

<h3 class="text-monospace" id="sec-unique-entity-types">unique_entity_types</h3>
<hr>

<p>The <code>unique_entity_types</code> field uses the {{ guide_link(DataSchemas\Range::class, 1) }} to state the minimum number of unique entity types (determined by their ID, e.g. <code>minecraft:creeper</code>) that must be killed by a single projectile shot from a crossbow (which will need the Piercing enchantment to do so).</p>

<p>Due to the way in which this trigger activates (being each time a piercing projectile encounters and entity), the value of <code>unique_entity_types</code> cannot describe a maximum, only a minimum. This currently makes the use of <code>min</code> and <code>max</code> options of a range pointless, as any value is essentially a minimum.</p>

<p>For example, the following requires at least 2 different entity types be killed. If 2 creepers are killed, the trigger will fail. If a creeper and a zombie are killed, the trigger will succeed.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\KilledByCrossbow::class, 'unique_entity_types', $example_data)])

@include('sourceblock::utils.data-schema-modals', [
    'modal_title' => trans('sourceblock::App/titles.minecraft.data-schemas.meta.modal-title'),
    'modal_data_schemas' => [
        [
            'schema' => DataSchemas\Entity::class,
            'path' => 'criteria.custom_test_name.conditions.victims[]'
        ],
        [
            'schema' => DataSchemas\Range::class,
            'path' => 'criteria.custom_test_name.conditions.unique_entity_types'
        ]
    ]
])
