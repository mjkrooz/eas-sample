<h2 class="text-monospace" id="sec-enter-block"><span class="text-muted">minecraft:</span>enter_block</h2>
<p>This triggers whenever the player's hitbox intersects with a block, including air, as well as the block at the location an enderpearl had landed at. As such, the following triggers constantly because the player is always in a block.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\EnterBlock::class, 'main')])

<p>There are 3 conditions for this trigger: <code><a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}#sec-player-condition">player</a></code>, <code>block</code>, <code>state</code>.</p>

<h3 class="text-monospace" id="sec-block">block</h3>
<hr>

<p>The <code>block</code> string checks if the block the player's hitbox is intersecting is a specific block ID. A list of valid blocks can be found <a href="https://github.com/Arcensoth/mcdata/blob/master/processed/reports/registries/block/block.json" target="_blank">here</a>. Note that block tags cannot be used here.</p>

<p>The following will check if the player is inside an oak fence gate.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\EnterBlock::class, 'block', $example_data)])

<h3 class="text-monospace" id="sec-state">state</h3>
<hr>

<p>The <code>state</code> object uses the {{ guide_link(DataSchemas\BlockState::class, 0) }} to check the block state of the block the player's hitbox is intersecting. The following checks if the player is standing in a block that has the <code>open</code> state of "true", which can be fulfilled by standing doors or fence gates.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\EnterBlock::class, 'state', $example_data)])

@include('sourceblock::utils.data-schema-modals', [
    'modal_title' => trans('sourceblock::App/titles.minecraft.data-schemas.meta.modal-title'),
    'modal_data_schemas' => [
        [
            'schema' => DataSchemas\BlockState::class,
            'path' => 'criteria.custom_test_name.conditions.state'
        ]
    ]
])
