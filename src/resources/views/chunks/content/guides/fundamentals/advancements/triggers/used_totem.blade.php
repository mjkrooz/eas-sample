<h2 class="text-monospace" id="sec-used-totem"><span class="text-muted">minecraft:</span>used_totem</h2>
<p>This triggers when the player uses a totem of undying.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\UsedTotem::class, 'main')])

<p>There are 2 conditions for this trigger: <code><a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}#sec-player-condition">player</a></code>, <code>item</code>.</p>

<h3 class="text-monospace" id="sec-item">item</h3>
<hr>

<p>The <code>item</code> object uses the {{ guide_link(DataSchemas\Item::class, 0) }} to check item data for the totem <b>before</b> it was consumed. For example, the following activates if the player had 5 totems of undying in the stack before one was consumed to save the player.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\UsedTotem::class, 'item', $example_data)])

@include('sourceblock::utils.data-schema-modals', [
    'modal_title' => trans('sourceblock::App/titles.minecraft.data-schemas.meta.modal-title'),
    'modal_data_schemas' => [
        [
            'schema' => DataSchemas\Item::class,
            'path' => 'criteria.custom_test_name.conditions.item'
        ]
    ]
])
