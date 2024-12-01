<h2 class="text-monospace" id="sec-safely-harvest-honey"><span class="text-muted">minecraft:</span>safely_harvest_honey</h2>
<p>This trigger succeeds whenever the player harvests a beehive or bee nest (with shears or a glass bottle) while a lit campfire is up to 5 blocks below the hive.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\SafelyHarvestHoney::class, 'main')])

<p>There are 4 conditions for this trigger: <code><a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}#sec-player-condition">player</a></code>, <code>block</code>, <code>state</code>, <code>item</code>.</p>

<h3 class="text-monospace" id="sec-block">block</h3>
<hr>

<p>The <code>block</code> object uses the {{ guide_link(DataSchemas\Block::class, 0) }} to check the beehive block's data <b>after</b> the player harvested it. The following will check if it was a beehive instead of a bee nest and with any amount of bees inside it.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\SafelyHarvestHoney::class, 'block1', $example_data)])

<p>Since the trigger occurs after harvesting, the block state will show a honey level of 0, thus the following will succeed.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\SafelyHarvestHoney::class, 'block2', $example_data)])

<h3 class="text-monospace" id="sec-state">state</h3>
<hr>

<p>The <code>state</code> object uses the {{ guide_link(DataSchemas\BlockState::class, 1) }} to check the block state of the beehive after harvesting. Note that this is a redundancy of the <code>{{ guide_link(DataSchemas\Block::class, 0) }}.state</code> structure shown above and you can use either.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\SafelyHarvestHoney::class, 'state', $example_data)])

<h3 class="text-monospace" id="sec-item">item</h3>
<hr>

<p>The <code>item</code> object uses the {{ guide_link(DataSchemas\Item::class, 2) }} to check the item the player used to harvest the beehive. This can be either shears or a glass bottle. The following checks if the player had sheared the beehive with a pair of shears that has custom NBT data.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\SafelyHarvestHoney::class, 'item', $example_data)])

@include('sourceblock::utils.data-schema-modals', [
    'modal_title' => trans('sourceblock::App/titles.minecraft.data-schemas.meta.modal-title'),
    'modal_data_schemas' => [
        [
            'schema' => DataSchemas\Block::class,
            'path' => 'criteria.custom_test_name.conditions.block'
        ],
        [
            'schema' => DataSchemas\BlockState::class,
            'path' => 'criteria.custom_test_name.conditions.state'
        ],
        [
            'schema' => DataSchemas\Item::class,
            'path' => 'criteria.custom_test_name.conditions.item'
        ]
    ]
])
