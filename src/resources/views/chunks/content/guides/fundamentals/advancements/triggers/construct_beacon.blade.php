<h2 class="text-monospace" id="sec-construct-beacon"><span class="text-muted">minecraft:</span>construct_beacon</h2>
<p>This triggers every time the player receives an effect update from a beacon, not when physically constructing a beacon pyramid. The beacon does not need to have any effects selected for this update to occur, but the player does need to be in range as usual. <b>The beacon does not need to be placed on a valid pyramid structure.</b></p>

<p>For example, the following will trigger if the player is close enough to a beacon to receive its effect, regardless of an effect is selected or even if there is a valid pyramid beneath the beacon.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\ConstructBeacon::class, 'main')])

<p>There are 2 conditions for this trigger: <code><a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}#sec-player-condition">player</a></code>, <code>level</code>.</p>

<h3 class="text-monospace" id="sec-level">level</h3>
<hr>

<p>The <code>level</code> field uses the {{ guide_link(DataSchemas\Range::class, 0) }} to check the number of levels the beacon pyramid has, up to 4. For example, the following checks if the beacon pyramid has at least 2 levels when the player receives an effect update.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\ConstructBeacon::class, 'level1', $example_data)])

<p>While the following checks if the player is receiving an update from a beacon that does not have a pyramid associated with it.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\ConstructBeacon::class, 'level2', $example_data)])

@include('sourceblock::utils.data-schema-modals', [
    'modal_title' => trans('sourceblock::App/titles.minecraft.data-schemas.meta.modal-title'),
    'modal_data_schemas' => [
        [
            'schema' => DataSchemas\Range::class,
            'path' => 'criteria.custom_test_name.conditions.level'
        ]
    ]
])
