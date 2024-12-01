<h2 class="text-monospace" id="sec-entity-killed-player"><span class="text-muted">minecraft:</span>entity_killed_player</h2>
<p>This triggers when any living entity kills the player. This includes mobs, armor stands, and other players, as well as indirect kills from those entities (such as a skeleton killing the player with an arrow).</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\EntityKilledPlayer::class, 'main')])

<p>There are 3 conditions for this trigger: <code><a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}#sec-player-condition">player</a></code>, <code>entity</code>, <code>killing_blow</code>.</p>

<h3 class="text-monospace" id="sec-entity">entity</h3>
<hr>

<p>The <code>entity</code> object uses the {{ guide_link(DataSchemas\Entity::class, 0) }} to check the mob that killed the player against the specified entity object. The following triggers if the player was killed by a creeper.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\EntityKilledPlayer::class, 'entity1', $example_data)])

<p>The origin for the distance range for the entity will be the mob's location. That is, the value will describe the distance between the player and the mob that killed them. The following checks if the player was killed by a skeleton while being within 3 blocks of it.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\EntityKilledPlayer::class, 'entity2', $example_data)])

<h3 class="text-monospace" id="sec-killing-blow">killing_blow</h3>
<hr>

<p>The <code>killing_blow</code> object uses the {{ guide_link(DataSchemas\DamageSource::class, 1) }} to check the damage the entity had dealt for the killing blow. The following triggers if the player is killed by a skeleton that didn't deal projectile damage.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\EntityKilledPlayer::class, 'killing_blow', $example_data)])

@include('sourceblock::utils.data-schema-modals', [
    'modal_title' => trans('sourceblock::App/titles.minecraft.data-schemas.meta.modal-title'),
    'modal_data_schemas' => [
        [
            'schema' => DataSchemas\Entity::class,
            'path' => 'criteria.custom_test_name.conditions.entity'
        ],
        [
            'schema' => DataSchemas\DamageSource::class,
            'path' => 'criteria.custom_test_name.conditions.killing_blow'
        ]
    ]
])
