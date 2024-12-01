<h2 class="text-monospace" id="sec-item-durability-changed"><span class="text-muted">minecraft:</span>item_durability_changed</h2>
<p>This triggers whenever an item in the player's inventory has taken a loss of durability. The following will trigger whenever any item in the player's inventory takes damage:</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\ItemDurabilityChanged::class, 'main')])

<p>There are 4 conditions for this trigger: <code><a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}#sec-player-condition">player</a></code>, <code>item</code>, <code>durability</code>, <code>delta</code>.</p>

<h3 class="text-monospace" id="sec-item">item</h3>
<hr>

<p>The <code>item</code> object uses the {{ guide_link(DataSchemas\Item::class, 0) }} to check the damaged item with the data provided. This specifically checks the item before it was damaged, allowing you to check its durability and other data prior to durability loss. The following checks if the player used a diamond sword that had 1540 or more durability remaining before being damaged.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\ItemDurabilityChanged::class, 'item', $example_data)])

<h3 class="text-monospace" id="sec-durability">durability</h3>
<hr>

<p>The <code>durability</code> field uses the {{ guide_link(DataSchemas\Range::class, 1) }} to check the item's remaining durability after the item was damaged. The following checks if a shield had at most 10 durability remaining after being damaged.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\ItemDurabilityChanged::class, 'durability', $example_data)])

<h3 class="text-monospace" id="sec-delta">delta</h3>
<hr>

<p>The <code>delta</code> field uses the {{ guide_link(DataSchemas\Range::class, 2) }} to check the change in durability of the item. For example, the following checks if the item had a change of -2 durability or more (took 2+ points of damage).</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\ItemDurabilityChanged::class, 'delta', $example_data)])

@include('sourceblock::utils.data-schema-modals', [
    'modal_title' => trans('sourceblock::App/titles.minecraft.data-schemas.meta.modal-title'),
    'modal_data_schemas' => [
        [
            'schema' => DataSchemas\Item::class,
            'path' => 'criteria.custom_test_name.conditions.item'
        ],
        [
            'schema' => DataSchemas\Range::class,
            'path' => 'criteria.custom_test_name.conditions.durability'
        ],
        [
            'schema' => DataSchemas\Range::class,
            'path' => 'criteria.custom_test_name.conditions.delta'
        ]
    ]
])
