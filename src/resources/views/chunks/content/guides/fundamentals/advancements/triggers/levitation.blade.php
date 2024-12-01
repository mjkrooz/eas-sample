<h2 class="text-monospace" id="sec-levitation"><span class="text-muted">minecraft:</span>levitation</h2>
<p>This triggers whenever the player is under the Levitation potion effect.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\Levitation::class, 'main')])

<p>There are 3 conditions for this trigger: <code><a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}#sec-player-condition">player</a></code>, <code>duration</code>, <code>distance</code>.</p>

<h3 class="text-monospace" id="sec-duration">duration</h3>
<hr>

<p>The <code>duration</code> field uses the {{ guide_link(DataSchemas\Range::class, 0) }} to check how the number of ticks the player has been levitating (not how long the effect itself was set to last). Note that this internal timer will not reset until the Levitation effect is removed, thus revoking the advancement after it was achieved will simply cause it to be achieved immediately after if the player is still under the Levitation effect. The following triggers when the player has been under the Levitation effect for 40 or more ticks.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\Levitation::class, 'duration', $example_data)])

<h3 class="text-monospace" id="sec-distance">distance</h3>
<hr>

<p>The <code>distance</code> object uses the {{ guide_link(DataSchemas\Distance::class, 1) }} to check how the number of blocks away the player has traveled from the moment they received the effect. The following checks if the player has is still within 10 blocks (regardless of direction) of where they received the effect.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\Levitation::class, 'distance', $example_data)])

@include('sourceblock::utils.data-schema-modals', [
    'modal_title' => trans('sourceblock::App/titles.minecraft.data-schemas.meta.modal-title'),
    'modal_data_schemas' => [
        [
            'schema' => DataSchemas\Range::class,
            'path' => 'criteria.custom_test_name.conditions.duration'
        ],
        [
            'schema' => DataSchemas\Distance::class,
            'path' => 'criteria.custom_test_name.conditions.distance'
        ]
    ]
])
