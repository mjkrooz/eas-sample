<h2 class="text-monospace" id="sec-player-killed-entity"><span class="text-muted">minecraft:</span>player_killed_entity</h2>
<p>This triggers when the player kills any living entity. This includes mobs and other players, but excluding armor stands, as well as indirect kills for those entities (such as the player killing another player with an arrow).</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\PlayerKilledEntity::class, 'main')])

<p>There are 3 conditions for this trigger: <code><a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}#sec-player-condition">player</a></code>, <code>entity</code>, <code>killing_blow</code>.</p>

<h3 class="text-monospace" id="sec-entity">entity</h3>
<hr>

<p>The <code>entity</code> object uses the {{ guide_link(DataSchemas\Entity::class, 0) }} to check the entity the player killed. The following triggers if the player kills a cow.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\PlayerKilledEntity::class, 'entity1', $example_data)])

<p>The origin for the distance range for the entity will be the mob's location. That is, the value will describe the distance between the entity that died and the player that killed it. The following checks if the player had killed a skeleton with a projectile while being 50+ blocks away from it.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\PlayerKilledEntity::class, 'entity2', $example_data)])

<h3 class="text-monospace" id="sec-killing-blow">killing_blow</h3>
<hr>

<p>The <code>killing_blow</code> object uses the {{ guide_link(DataSchemas\DamageSource::class, 1) }} to check various flags for the damage the player had dealt for the killing blow. The following triggers if the player kills a creeper without projectile damage.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\PlayerKilledEntity::class, 'killing_blow', $example_data)])

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
