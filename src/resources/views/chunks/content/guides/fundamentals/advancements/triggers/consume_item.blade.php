<h2 class="text-monospace" id="sec-consume-item"><span class="text-muted">minecraft:</span>consume_item</h2>
<p>This triggers whenever the player eats food, drinks milk, or drinks a potion/water bottle.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\ConsumeItem::class, 'main')])

<p>There are 2 conditions for this trigger: <code><a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}#sec-player-condition">player</a></code>, <code>item</code>.</p>

<h3 class="text-monospace" id="sec-item">item</h3>
<hr>

<p>The <code>item</code> object uses the {{ guide_link(DataSchemas\Item::class, 0) }} to check the item before it was consumed. For example, the following activates if the player had 2 golden apples in the stack and ate 1 of them.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\ConsumeItem::class, 'item', $example_data)])

@include('sourceblock::utils.data-schema-modals', [
    'modal_title' => trans('sourceblock::App/titles.minecraft.data-schemas.meta.modal-title'),
    'modal_data_schemas' => [
        [
            'schema' => DataSchemas\Item::class,
            'path' => 'criteria.custom_test_name.conditions.item'
        ]
    ]
])
