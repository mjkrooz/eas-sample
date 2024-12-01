<h2 class="text-monospace" id="sec-filled-bucket"><span class="text-muted">minecraft:</span>filled_bucket</h2>
<p>This triggers when the player fills a bucket item with water or lava, or picks up a fish entity with a bucket.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\FilledBucket::class, 'main')])

<p>There are 2 conditions for this trigger: <code><a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}#sec-player-condition">player</a></code>, <code>item</code>.</p>

<h3 class="text-monospace" id="sec-item">item</h3>
<hr>

<p>The <code>item</code> object uses the {{ guide_link(DataSchemas\Item::class, 0) }} to check the bucket item after it was filled. For example, the following will only succeed if the bucket became a bucket of lava.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\FilledBucket::class, 'item', $example_data)])

@include('sourceblock::utils.data-schema-modals', [
    'modal_title' => trans('sourceblock::App/titles.minecraft.data-schemas.meta.modal-title'),
    'modal_data_schemas' => [
        [
            'schema' => DataSchemas\Item::class,
            'path' => 'criteria.custom_test_name.conditions.item'
        ]
    ]
])
