<h2 class="text-monospace" id="sec-location"><span class="text-muted">minecraft:</span>location</h2>
<p>This triggers every second (every 20 ticks) at all times, essentially requiring the use of conditions despite them being optional for this trigger. However, this activation can be useful if needing a 1-second timer. The following will always activate every second.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\Location::class, 'main')])

<p>This trigger uses only the {{ guide_link(DataSchemas\Location::class, 0) }} to check various data and the <code><a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}#sec-player-condition">player</a></code> condition. The origin of the location is the player's coordinates.</p>

<p>For example, the following only succeeds if the player was in a desert biome.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\Location::class, 'location', $example_data)])

@include('sourceblock::utils.data-schema-modals', [
    'modal_title' => trans('sourceblock::App/titles.minecraft.data-schemas.meta.modal-title'),
    'modal_data_schemas' => [
        [
            'schema' => DataSchemas\Location::class,
            'path' => 'criteria.custom_test_name.conditions'
        ]
    ]
])
