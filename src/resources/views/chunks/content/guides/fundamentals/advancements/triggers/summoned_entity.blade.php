<h2 class="text-monospace" id="sec-summoned-entity"><span class="text-muted">minecraft:</span>summoned_entity</h2>
<p>This triggers when the player creates an entity in specific manners. Valid methods are: constructing a wither, constructing a snow golem, constructing an iron golem, and respawning the ender dragon. In the case of the ender dragon, all players able to view the boss bar at the time of respawning will fulfill the trigger. The following triggers when the player summons any of the valid entities.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\SummonedEntity::class, 'main')])

<p>There are 2 conditions for this trigger: <code><a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}#sec-player-condition">player</a></code>, <code>entity</code>.</p>

<h3 class="text-monospace" id="sec-entity">entity</h3>
<hr>

<p>The <code>entity</code> object uses the {{ guide_link(DataSchemas\Entity::class, 0) }} to check the entity summoned. The following triggers if the player resummons the ender dragon.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\SummonedEntity::class, 'entity1', $example_data)])

<p>The origin for the distance range for the entity will be the summoned mob's location. That is, the value will describe the distance between the entity that was summoned and the player that summoned it, or between the ender dragon and all elligible players. The following checks if the player is within 10 blocks of the ender dragon when the summoning ritual is complete, which would be very high in the air.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\SummonedEntity::class, 'entity2', $example_data)])

@include('sourceblock::utils.data-schema-modals', [
    'modal_title' => trans('sourceblock::App/titles.minecraft.data-schemas.meta.modal-title'),
    'modal_data_schemas' => [
        [
            'schema' => DataSchemas\Entity::class,
            'path' => 'criteria.custom_test_name.conditions.entity'
        ]
    ]
])
