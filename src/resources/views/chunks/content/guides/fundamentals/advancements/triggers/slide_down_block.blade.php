<h2 class="text-monospace" id="sec-slide-down-block"><span class="text-muted">minecraft:</span>slide_down_block</h2>
<p>This triggers for players that are sliding down the side of a honey block, but only once every 20 ticks.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\SlideDownBlock::class, 'main')])

<p>There are 3 conditions for this trigger: <code><a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}#sec-player-condition">player</a></code>, <code>block</code>, <code>state</code>.</p>

<h3 class="text-monospace" id="sec-block">block</h3>
<hr>

<p>The <code>block</code> string checks the block ID of the honey block. However, this can only ever be <code>minecraft:honey_block</code>, meaning that this condition serves no purpose.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\SlideDownBlock::class, 'block', $example_data)])

<h3 class="text-monospace" id="sec-state">state</h3>
<hr>

<p>The <code>state</code> object uses the {{ guide_link(DataSchemas\BlockState::class, 0) }} to check the block state of the block the honey block. However, since honey blocks do not have any block states, this condition serves no purpose.</p>

@include('sourceblock::utils.data-schema-modals', [
    'modal_title' => trans('sourceblock::App/titles.minecraft.data-schemas.meta.modal-title'),
    'modal_data_schemas' => [
        [
            'schema' => DataSchemas\BlockState::class,
            'path' => 'criteria.custom_test_name.conditions.state'
        ]
    ]
])
