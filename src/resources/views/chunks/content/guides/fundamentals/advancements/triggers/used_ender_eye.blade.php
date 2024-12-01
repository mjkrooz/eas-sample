<h2 class="text-monospace" id="sec-used-ender-eye"><span class="text-muted">minecraft:</span>used_ender_eye</h2>
<p>This triggers when the player uses an eye of ender.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\UsedEnderEye::class, 'main')])

<p>There are 2 conditions for this trigger: <code><a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}#sec-player-condition">player</a></code>, <code>distance</code>.</p>

<h3 class="text-monospace" id="sec-distance">distance</h3>
<hr>

<p>The <code>distance</code> field uses the {{ guide_link(DataSchemas\Range::class, 0) }} to check the number of blocks away the player (not the Eye of Ender) is to the nearest stronghold's center. It only takes into consideration the X and Z coordinate, ignoring the Y coordinate.</p>

<p>The formula for determining the distance from the player to the stronghold is:</p>

<pre><code>sqrt((player.X - stronghold.X)^2 + (player.Z - stronghold.Z)^2)</code></pre>

<p>For example, if the player was at (40, 64, 10) and the stronghold was at (120, 25, 400), the resulting distance needed to encompass the player is at least 398:</p>

<pre><code>sqrt((40 - 120)^2 + (10 - 400)^2) = 398</code></pre>

<p>Thus the following will trigger if the player is standing at (40, 64, 10) with the stronghold at (120, 25, 400). If the player moves one block further away, they will no longer be detected.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\UsedEnderEye::class, 'distance', $example_data)])

@include('sourceblock::utils.data-schema-modals', [
    'modal_title' => trans('sourceblock::App/titles.minecraft.data-schemas.meta.modal-title'),
    'modal_data_schemas' => [
        [
            'schema' => DataSchemas\Range::class,
            'path' => 'criteria.custom_test_name.conditions.distance'
        ]
    ]
])
