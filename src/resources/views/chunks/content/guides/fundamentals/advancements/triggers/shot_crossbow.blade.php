<h2 class="text-monospace" id="sec-shot-crossbow"><span class="text-muted">minecraft:</span>shot_crossbow</h2>
<p>This triggers whenever the player fires a crossbow.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\ShotCrossbow::class, 'main')])

<p>There are 2 conditions for this trigger: <code><a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}#sec-player-condition">player</a></code>, <code>item</code>.</p>

<h3 class="text-monospace" id="sec-item">item</h3>
<hr>

<p>The <code>item</code> object uses the {{ guide_link(DataSchemas\Item::class, 0) }} to describe the crossbow itself before the projectile was removed from the crossbow. For example, the following checks if the crossbow had shot a firework.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\ShotCrossbow::class, 'item', $example_data)])

@include('sourceblock::utils.data-schema-modals', [
    'modal_title' => trans('sourceblock::App/titles.minecraft.data-schemas.meta.modal-title'),
    'modal_data_schemas' => [
        [
            'schema' => DataSchemas\Item::class,
            'path' => 'criteria.custom_test_name.conditions.item'
        ]
    ]
])
