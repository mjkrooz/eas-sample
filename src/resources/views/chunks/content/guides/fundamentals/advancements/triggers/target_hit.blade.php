<h2 class="text-monospace" id="sec-target-hit"><span class="text-muted">minecraft:</span>target_hit</h2>
<p>This triggers when the player shoots a target block with a projectile.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\TargetHit::class, 'main')])

<p>There are 4 conditions for this trigger: <code><a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}#sec-player-condition">player</a></code>, <code>signal_strength</code>, <code>projectile</code>, <code>shooter</code>.</p>

<h3 class="text-monospace" id="sec-signal-strength">signal_strength</h3>
<hr>

<p>The <code>signal_strength</code> field uses the {{ guide_link(DataSchemas\Range::class, 0) }} to check the signal strength output of the target block, which is based on how close the projectile is to the center of the block. The following checks if the signal strength is at least 10.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\TargetHit::class, 'signal_strength', $example_data)])

<h3 class="text-monospace" id="sec-projectile">projectile</h3>
<hr>

<p>The <code>projectile</code> object uses the {{ guide_link(DataSchemas\Entity::class, 1) }} to check the projectile that hit the target block. The following checks if the projectile was a snowball.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\TargetHit::class, 'projectile', $example_data)])

<h3 class="text-monospace" id="sec-shooter">shooter</h3>
<hr>

<p>The <code>shooter</code> object uses the {{ guide_link(DataSchemas\Entity::class, 2) }} to check the player that shot the projectile. The following checks if the player is in creative mode.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\TargetHit::class, 'shooter', $example_data)])

@include('sourceblock::utils.data-schema-modals', [
    'modal_title' => trans('sourceblock::App/titles.minecraft.data-schemas.meta.modal-title'),
    'modal_data_schemas' => [
        [
            'schema' => DataSchemas\Range::class,
            'path' => 'criteria.custom_test_name.conditions.signal_strength'
        ],
        [
            'schema' => DataSchemas\Entity::class,
            'path' => 'criteria.custom_test_name.conditions.projectile'
        ],
        [
            'schema' => DataSchemas\Entity::class,
            'path' => 'criteria.custom_test_name.conditions.shooter'
        ]
    ]
])
