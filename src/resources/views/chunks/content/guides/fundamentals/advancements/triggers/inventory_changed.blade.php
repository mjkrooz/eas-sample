<h2 class="text-monospace" id="sec-inventory-changed"><span class="text-muted">minecraft:</span>inventory_changed</h2>
<p>This triggers whenever the player's inventory is updated, such as from removing an item or adding an item. If the player has an interface open, such as their inventory interface, the trigger will not run until after they close their inventory. After that happens, the trigger runs once.</p>

<p>The following will trigger from any addition or removal of items from the player's inventory:</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\InventoryChanged::class, 'main')])

<p>There are 3 conditions for this trigger: <code><a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}#sec-player-condition">player</a></code>, <code>slots</code>, <code>items</code>.</p>

<h3 class="text-monospace" id="sec-slots">slots</h3>
<hr>
{{-- TODO: this modal doesn't work as expected, have to separate it. --}}
<p>The <code>slots</code> object contains generic information about all slots in the inventory. Within it are three possible fields to specify, all of which use the {{ guide_link(DataSchemas\Range::class) }}: <code>occupied</code>, <code>full</code>, and <code>empty</code>. The armor and offhand slots are included in these checks alongside the main inventory.</p>

<ul>
    <li>The <code>occupied</code> range indicates the number of slots that have an item in it.</li>
    <li>The <code>full</code> range indicates the number of slots that have the highest number of items possible for that slot (such as 1 diamond pickaxe or 64 stone blocks).</li>
    <li>The <code>empty</code> range indicates the number of empty slots.</li>
</ul>

<p>For example, the following will trigger when the player has exactly 10 empty slots in their inventory at the time that their inventory gets updated.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\InventoryChanged::class, 'slots', $example_data)])

<h3 class="text-monospace" id="sec-items">items</h3>
<hr>

<p>The <code>items</code> list contains objects that use the {{ guide_link(DataSchemas\Item::class, 1) }} to check the player's inventory for each item specified. The player's inventory must match all items. The following checks if the player has both stone and dirt in their inventory at the time their inventory gets updated.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\InventoryChanged::class, 'items', $example_data)])

@include('sourceblock::utils.data-schema-modals', [
    'modal_title' => trans('sourceblock::App/titles.minecraft.data-schemas.meta.modal-title'),
    'modal_data_schemas' => [
        [
            'schema' => DataSchemas\Range::class,
            'path' => 'criteria.custom_test_name.conditions.slots'
        ],
        [
            'schema' => DataSchemas\Item::class,
            'path' => 'criteria.custom_test_name.conditions.items[]'
        ]
    ]
])
