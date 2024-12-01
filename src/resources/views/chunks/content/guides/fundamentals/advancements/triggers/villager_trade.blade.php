<h2 class="text-monospace" id="sec-villager-trade"><span class="text-muted">minecraft:</span>villager_trade</h2>
<p>This triggers whenever the player completes a trade with a villager. Note that shift-clicking to complete a trade multiple times will only trigger this for the first trade that tick.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\VillagerTrade::class, 'main')])

<p>There are 3 conditions for this trigger: <code><a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}#sec-player-condition">player</a></code>, <code>villager</code>, <code>item</code>.</p>

<h3 class="text-monospace" id="sec-villager">villager</h3>
<hr>

<p>The <code>villager</code> object uses the {{ guide_link(DataSchemas\Entity::class, 0) }} to check information about the villager that was traded with. In this case, the <code>type</code> string is useless as it will always be <code>minecraft:villager</code>.</p>

<p>The origin for the distance range villager's location. That is, the value will describe the distance between the villager being traded with and the player that traded with it. The following checks if the player is within 1 block of the villager when completing a trade.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\VillagerTrade::class, 'villager', $example_data)])

<h3 class="text-monospace" id="sec-item">item</h3>
<hr>

<p>The <code>item</code> object uses the {{ guide_link(DataSchemas\Item::class, 1) }} to check information about the item that was <b>purchased</b>. In terms of the count, keep in mind that this only accounts for one trade. If a villager was selling 2 sugar per emerald, shift-clicking to receive 10 sugar would still only count as 2 sugar as far as the advancement goes, as the first completed trade of the bunch was for 2 sugar. The following checks if the purchased item was sugar.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\VillagerTrade::class, 'item', $example_data)])

@include('sourceblock::utils.data-schema-modals', [
    'modal_title' => trans('sourceblock::App/titles.minecraft.data-schemas.meta.modal-title'),
    'modal_data_schemas' => [
        [
            'schema' => DataSchemas\Entity::class,
            'path' => 'criteria.custom_test_name.conditions.villager'
        ],
        [
            'schema' => DataSchemas\Item::class,
            'path' => 'criteria.custom_test_name.conditions.item'
        ]
    ]
])
