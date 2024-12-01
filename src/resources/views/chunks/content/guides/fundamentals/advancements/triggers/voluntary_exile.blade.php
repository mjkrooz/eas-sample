<h2 class="text-monospace" id="sec-voluntary-exile"><span class="text-muted">minecraft:</span>voluntary_exile</h2>
<p>This triggers when the player causes a raid to begin by entering a village while afflicted with the Bad Omen status effect.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\VoluntaryExile::class, 'main')])

<p>This trigger uses only the {{ guide_link(DataSchemas\Location::class, 0) }} to check various data and the <code><a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}#sec-player-condition">player</a></code> condition. The origin of the location is the player's coordinates.</p>

<p>The following only succeeds if the player was in a desert biome when the raid began.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\VoluntaryExile::class, 'location', $example_data)])

@include('sourceblock::utils.data-schema-modals', [
    'modal_title' => trans('sourceblock::App/titles.minecraft.data-schemas.meta.modal-title'),
    'modal_data_schemas' => [
        [
            'schema' => DataSchemas\Location::class,
            'path' => 'criteria.custom_test_name.conditions'
        ]
    ]
])
