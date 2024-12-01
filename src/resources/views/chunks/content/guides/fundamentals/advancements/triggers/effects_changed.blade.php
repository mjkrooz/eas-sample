<h2 class="text-monospace" id="sec-effects-changed"><span class="text-muted">minecraft:</span>effects_changed</h2>
<p>This triggers whenever the player receives or loses an effect. This will also trigger each time any single active effect reaches <code>(duration - 1) % 600 == 0</code>.</p>

<p>Thus if an effect is newly applied for 61 seconds, it will trigger <code>effects_changed</code> immediately due to it being newly applied, and then 19 ticks later (<code>(1220 - 1) % 600 = 19</code>). Applying an effect with a duration of 60 seconds will cause it to apply immediately due to it being newly applied, but it will be 599 ticks until it triggers effects_changed again (<code>(1200 - 1) % 600 = 599</code>).</p>

<p>If two effects were applied, one for 61 seconds and one for 62 seconds, they will both immediately trigger <code>effects_changed</code> due to being newly applied, and then the advancement will be triggered two more times: 19 ticks and 39 ticks after application.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\EffectsChanged::class, 'main')])

<p>There are 2 conditions for this trigger: <code><a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}#sec-player-condition">player</a></code>, <code>effects</code>.</p>

<h3 class="text-monospace" id="sec-effects">effects</h3>
<hr>

<p>The <code>effects</code> object uses the {{ guide_link(DataSchemas\StatusEffects::class, 0) }} to check the player's whole list of effects whenever any effect is applied, lost, or periodically updated. However, keep in mind that if the player lost an effect to trigger this advancement, it cannot be detected. The following checks if the player has Levitation.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\EffectsChanged::class, 'effects', $example_data)])

@include('sourceblock::utils.data-schema-modals', [
    'modal_title' => trans('sourceblock::App/titles.minecraft.data-schemas.meta.modal-title'),
    'modal_data_schemas' => [
        [
            'schema' => DataSchemas\StatusEffects::class,
            'path' => 'criteria.custom_test_name.conditions.effects'
        ]
    ]
])
