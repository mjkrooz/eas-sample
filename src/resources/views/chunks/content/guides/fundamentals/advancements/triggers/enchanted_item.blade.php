<h2 class="text-monospace" id="sec-enchanted-item"><span class="text-muted">minecraft:</span>enchanted_item</h2>
<p>This triggers whenever the player enchants an item in an enchanting table. The player does not have to remove the item, as it is triggered when selecting which enchantment to apply. The following triggers upon enchanting.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\EnchantedItem::class, 'main')])

<p>There are 3 conditions for this trigger: <code><a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}#sec-player-condition">player</a></code>, <code>item</code>, <code>levels</code>.</p>

<h3 class="text-monospace" id="sec-item">item</h3>
<hr>

<p>The <code>item</code> object uses the {{ guide_link(DataSchemas\Item::class, 0) }} to check the data of the enchanted item. Note that this check occurs after enchanting, which means that you can make use of the <code>enchantments</code> list to only fulfill the trigger if a specific enchantment was received. The following will trigger if the item that was enchanted is a diamond pickaxe, and received any level of Fortune.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\EnchantedItem::class, 'item', $example_data)])

<h3 class="text-monospace" id="sec-levels">levels</h3>
<hr>

<p>The <code>levels</code> field uses the {{ guide_link(DataSchemas\Range::class, 1) }} to specify the number of levels spent to receive the enchantment. For example, with 15 bookshelves, selecting the third option requires 30 levels and costs 3 levels. This condition checks that cost of 3 levels. This does mean that you can't ensure the player had to have 30 levels from the advancement alone, but could use commands to help detect that.</p>

<p>The following will trigger if the player spends 3 levels on an enchantment.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\EnchantedItem::class, 'levels', $example_data)])

@include('sourceblock::utils.data-schema-modals', [
    'modal_title' => trans('sourceblock::App/titles.minecraft.data-schemas.meta.modal-title'),
    'modal_data_schemas' => [
        [
            'schema' => DataSchemas\Item::class,
            'path' => 'criteria.custom_test_name.conditions.item'
        ],
        [
            'schema' => DataSchemas\Range::class,
            'path' => 'criteria.custom_test_name.conditions.levels'
        ]
    ]
])
