<h2 class="text-monospace" id="sec-nether-travel"><span class="text-muted">minecraft:</span>nether_travel</h2>
<p>This triggers when the player travels to the Nether and then returns to the Overworld.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\NetherTravel::class, 'main')])

<p>There are 4 conditions for this trigger: <code><a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}#sec-player-condition">player</a></code>, <code>entered</code>, <code>exited</code>, <code>distance</code>.</p>

<h3 class="text-monospace" id="sec-entered">entered</h3>
<hr>

<p>The <code>entered</code> object uses the {{ guide_link(DataSchemas\Location::class, 0) }} to check the location of the nether portal that the player entered the nether through. The following checks if that nether portal was in a desert biome.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\NetherTravel::class, 'entered', $example_data)])

<h3 class="text-monospace" id="sec-exited">exited</h3>
<hr>

<p>The <code>exited</code> object uses the {{ guide_link(DataSchemas\Location::class, 1) }} to check the location of the nether portal that the player arrived to in the overworld after leaving the nether through a portal. The following checks if that nether portal was in the positive X and Z coordinates.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\NetherTravel::class, 'exited', $example_data)])

<h3 class="text-monospace" id="sec-distance">distance</h3>
<hr>

<p>The <code>distance</code> object uses the {{ guide_link(DataSchemas\Distance::class, 2) }} to check the distance between the two nether portals positioned in the overworld. The following checks if they are horizontally 500 blocks apart.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\NetherTravel::class, 'distance', $example_data)])

@include('sourceblock::utils.data-schema-modals', [
    'modal_title' => trans('sourceblock::App/titles.minecraft.data-schemas.meta.modal-title'),
    'modal_data_schemas' => [
        [
            'schema' => DataSchemas\Location::class,
            'path' => 'criteria.custom_test_name.conditions.entered'
        ],
        [
            'schema' => DataSchemas\Location::class,
            'path' => 'criteria.custom_test_name.conditions.exited'
        ],
        [
            'schema' => DataSchemas\Distance::class,
            'path' => 'criteria.custom_test_name.conditions.distance'
        ]
    ]
])
