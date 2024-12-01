<h2 class="text-monospace" id="sec-fishing-rod-hooked"><span class="text-muted">minecraft:</span>fishing_rod_hooked</h2>
<p>This triggers when the player reels back a fishing rod, either when it was attached to another entity or when successfully fishing up an item.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\FishingRodHooked::class, 'main')])

<p>There are 4 conditions for this trigger: <code><a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}#sec-player-condition">player</a></code>, <code>rod</code>, <code>entity</code>, <code>item</code>.</p>

<h3 class="text-monospace" id="sec-rod">rod</h3>
<hr>

<p>The <code>rod</code> object uses the {{ guide_link(DataSchemas\Item::class, 0) }} to check the fishing rod item that was used by the player. For example, the following only succeeds if the fishing rod had a custom test byte tag with the value of 1.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\FishingRodHooked::class, 'rod', $example_data)])

<h3 class="text-monospace" id="sec-entity">entity</h3>
<hr>

<p>The <code>entity</code> object uses the {{ guide_link(DataSchemas\Entity::class, 1) }} to check the entity that was hooked, if applicable. For example, the following only succeeds if the hooked entity was an armor stand.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\FishingRodHooked::class, 'entity', $example_data)])

<h3 class="text-monospace" id="sec-item">item</h3>
<hr>

<p>The <code>item</code> object uses the {{ guide_link(DataSchemas\Item::class, 2) }} to check the item that was fished up from regular fishing in water, if applicable. For example, the following only succeeds if the player fished up a cod item.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\FishingRodHooked::class, 'item', $example_data)])

@include('sourceblock::utils.data-schema-modals', [
    'modal_title' => trans('sourceblock::App/titles.minecraft.data-schemas.meta.modal-title'),
    'modal_data_schemas' => [
        [
            'schema' => DataSchemas\Item::class,
            'path' => 'criteria.custom_test_name.conditions.rod'
        ],
        [
            'schema' => DataSchemas\Entity::class,
            'path' => 'criteria.custom_test_name.conditions.entity'
        ],
        [
            'schema' => DataSchemas\Item::class,
            'path' => 'criteria.custom_test_name.conditions.item'
        ]
    ]
])
