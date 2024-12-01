<h2 class="text-monospace" id="sec-slept-in-bed"><span class="text-muted">minecraft:</span>slept_in_bed</h2>
<p>This triggers when the player successfully enters a bed (the player does not have to pass the night). For example if the bed explodes, such as from trying to sleep in the nether, this will not trigger.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\SleptInBed::class, 'main')])


<p>This trigger uses only the {{ guide_link(DataSchemas\Location::class, 0) }} to check various data and the <code><a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}#sec-player-condition">player</a></code> condition. The origin of the location is the player's coordinates after getting in the bed, which would be just above the bed's head.</p>

<p>The following will trigger when the player sleeps in a bed while their position indicates the biome their new position is in, being where the head of the bed is. While this was seemingly implemented as a way to detect the player sleeping in the nether, the bed exploding will not cause the trigger to be fulfilled. The following checks if the player slept in a desert biome.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\SleptInBed::class, 'location', $example_data)])

@include('sourceblock::utils.data-schema-modals', [
    'modal_title' => trans('sourceblock::App/titles.minecraft.data-schemas.meta.modal-title'),
    'modal_data_schemas' => [
        [
            'schema' => DataSchemas\Location::class,
            'path' => 'criteria.custom_test_name.conditions'
        ]
    ]
])
