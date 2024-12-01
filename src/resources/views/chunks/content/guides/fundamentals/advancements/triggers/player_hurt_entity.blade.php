<h2 class="text-monospace" id="sec-player-hurt-entity"><span class="text-muted">minecraft:</span>player_hurt_entity</h2>
<p>This triggers whenever the player deals any amount of damage to an entity, including 0 (e.g. snowballs).</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\PlayerHurtEntity::class, 'main')])

<p>There are 3 conditions for this trigger: <code><a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}#sec-player-condition">player</a></code>, <code>damage</code>, <code>entity</code>.</p>

<h3 class="text-monospace" id="sec-damage">damage</h3>
<hr>

<p>The <code>damage</code> object uses the {{ guide_link(DataSchemas\Damage::class, 0) }} to describe the damage the entity had taken by the player, complete with entity source to check information about the player. The following checks if the player dealt at least 10.0 raw projectile damage before damage reduction from the entity's gear, allowing for only up to 10% damage reduction.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\PlayerHurtEntity::class, 'damage', $example_data)])

<h3 class="text-monospace" id="sec-entity">entity</h3>
<hr>

<p>The <code>entity</code> object uses the {{ guide_link(DataSchemas\Entity::class, 1) }} to check information concerning the entity that the player had damaged. The following checks if the player dealt projectile damage to a zombie.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\PlayerHurtEntity::class, 'entity1', $example_data)])

<p>The origin for the <code>distance</code> range for this entity will be the entity's location. That is, the value will describe the distance between the entity taking the damage and the player dealing the damage. The following correctly checks if the player was within 3 blocks of the entity they damaged.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\PlayerHurtEntity::class, 'entity2', $example_data)])

@include('sourceblock::utils.data-schema-modals', [
    'modal_title' => trans('sourceblock::App/titles.minecraft.data-schemas.meta.modal-title'),
    'modal_data_schemas' => [
        [
            'schema' => DataSchemas\Damage::class,
            'path' => 'criteria.custom_test_name.conditions.damage'
        ],
        [
            'schema' => DataSchemas\Entity::class,
            'path' => 'criteria.custom_test_name.conditions.entity'
        ]
    ]
])
