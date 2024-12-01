<h2 class="text-monospace" id="sec-bee-nest-destroyed"><span class="text-muted">minecraft:</span>bee_nest_destroyed</h2>
<p>This trigger succeeds when a player breaks either a bee nest or beehive block.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\BeeNestDestroyed::class, 'main')])

<p>This trigger has 4 conditions: <code><a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}#sec-player-condition">player</a></code>, <code>block</code>, <code>item</code>, <code>num_bees_inside</code>.</p>

<h3 class="text-monospace" id="sec-block">block</h3>
<hr>

<p>The <code>block</code> string checks the block ID of the beehive block that was broken by the player. In vanilla, this can effectively only be <code>minecraft:beehive</code> and <code>minecraft:bee_nest</code>. For example, the following checks if the beehive block that the player destroyed was a bee nest.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\BeeNestDestroyed::class, 'block', $example_data)])

<h3 class="text-monospace" id="sec-item">item</h3>
<hr>

<p>The <code>item</code> object uses the {{ guide_link(DataSchemas\Item::class, 0) }} to check the item held by the player when they broke the block. For example, the following checks if the player was holding a diamond sword.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\BeeNestDestroyed::class, 'item', $example_data)])

<h3 class="text-monospace" id="sec-number-of-bees-inside">num_bees_inside</h3>
<hr>

<p>The <code>num_bees_inside</code> field uses the {{ guide_link(DataSchemas\Range::class, 1) }} to check the number of bees that were inside the hive at the time it was broken. The following checks if there were 1 to 2 bees inside the nest when it was broken.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\BeeNestDestroyed::class, 'num_bees_inside', $example_data)])

@include('sourceblock::utils.data-schema-modals', [
    'modal_title' => trans('sourceblock::App/titles.minecraft.data-schemas.meta.modal-title'),
    'modal_data_schemas' => [
        [
            'schema' => DataSchemas\Item::class,
            'path' => 'criteria.custom_test_name.conditions.item'
        ],
        [
            'schema' => DataSchemas\Range::class,
            'path' => 'criteria.custom_test_name.conditions.num_bees_inside'
        ]
    ]
])
