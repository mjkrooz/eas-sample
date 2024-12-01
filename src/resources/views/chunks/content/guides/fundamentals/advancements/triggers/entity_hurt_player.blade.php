<h2 class="text-monospace" id="sec-entity-hurt-player"><span class="text-muted">minecraft:</span>entity_hurt_player</h2>
<p>This triggers whenever the player takes any amount of damage (including 0), even when blocking.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\EntityHurtPlayer::class, 'main')])

<p>There are 2 conditions for this trigger: <code><a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}#sec-player-condition">player</a></code>, <code>damage</code>.</p>

<h3 class="text-monospace" id="sec-damage">damage</h3>
<hr>

<p>The <code>damage</code> object uses the {{ guide_link(DataSchemas\Damage::class, 0) }} to check the damage the player has taken, complete with entity source that dealt the damage. For example, the following checks if the player had taken 10+ health damage from an explosion caused by a creeper.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\EntityHurtPlayer::class, 'damage1', $example_data)])

<p>The origin for the <code>distance</code> for the source entity will be the mob's location. That is, the value will describe the distance between the entity causing the damage and the player taking the damage. The following checks if the player had taken damage from a skeleton while being within 3 blocks of that skeleton.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\EntityHurtPlayer::class, 'damage2', $example_data)])

@include('sourceblock::utils.data-schema-modals', [
    'modal_title' => trans('sourceblock::App/titles.minecraft.data-schemas.meta.modal-title'),
    'modal_data_schemas' => [
        [
            'schema' => DataSchemas\Damage::class,
            'path' => 'criteria.custom_test_name.conditions.damage'
        ]
    ]
])
