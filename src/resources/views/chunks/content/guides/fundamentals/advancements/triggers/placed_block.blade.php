<h2 class="text-monospace" id="sec-placed-block"><span class="text-muted">minecraft:</span>placed_block</h2>
<p>This triggers whenever the player places a block from their inventory.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\PlacedBlock::class, 'main')])

<p>There are 5 conditions for this trigger: <code><a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}#sec-player-condition">player</a></code>, <code>block</code>, <code>state</code>, <code>location</code>, <code>item</code>.</p>

<h3 class="text-monospace" id="sec-block">block</h3>
<hr>

<p>The <code>block</code> string checks the ID of the block that was placed. The following checks if the player placed down a skeleton skull against a wall.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\PlacedBlock::class, 'block', $example_data)])

<h3 class="text-monospace" id="sec-state">state</h3>
<hr>
<p>The <code>state</code> object uses the {{ guide_link(DataSchemas\BlockState::class, 0) }} to check the block state of the placed block. The following checks if the block has a state of <code>open</code> set to "true", which can be true for doors and fence gates.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\PlacedBlock::class, 'state', $example_data)])

<h3 class="text-monospace" id="sec-item">item</h3>
<hr>

<p>The <code>item</code> object uses the {{ guide_link(DataSchemas\Item::class, 1) }} to check information concerning the corresponding item that the player used to place the block before the item was consumed. The following checks if the player placed an unpowered repeater block (where the corresponding item is <code>minecraft:repeater</code>) that was the last item in the stack at the time of placing.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\PlacedBlock::class, 'item', $example_data)])

<h3 class="text-monospace" id="sec-location">location</h3>
<hr>

<p>The <code>location</code> object uses the {{ guide_link(DataSchemas\Location::class, 2) }} to check various location data about where the block was placed. For example, the following checks if glass block was placed anywhere at Y128 or higher.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\PlacedBlock::class, 'location', $example_data)])

@include('sourceblock::utils.data-schema-modals', [
    'modal_title' => trans('sourceblock::App/titles.minecraft.data-schemas.meta.modal-title'),
    'modal_data_schemas' => [
        [
            'schema' => DataSchemas\BlockState::class,
            'path' => 'criteria.custom_test_name.conditions.state'
        ],
        [
            'schema' => DataSchemas\Item::class,
            'path' => 'criteria.custom_test_name.conditions.item'
        ],
        [
            'schema' => DataSchemas\Location::class,
            'path' => 'criteria.custom_test_name.conditions.location'
        ]
    ]
])
