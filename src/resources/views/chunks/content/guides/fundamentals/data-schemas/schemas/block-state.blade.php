<h2 id="sec-shared-item-structure">Block state schema</h2>
<p>The fields within the schema consist of custom keys that correspond to the block state name to detect while the values corresponds to possible values for that block state. For the <code>minecraft:tallgrass</code> block, the <code>type</code> block state specifies which of the tallgrass blocks it is. The following checks if the <code>type</code> state is "fern".</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\BlockState::class, 'state1', $example_data)])

<p>Numerical values can be used with the {{ guide_link(DataSchemas\Range::class) }}. The following checks if the <code>power</code> state is between 3 and 12.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\BlockState::class, 'state2', $example_data)])