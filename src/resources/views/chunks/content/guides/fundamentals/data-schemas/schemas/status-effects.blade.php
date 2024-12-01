<h2 id="sec-shared-item-structure">Status effects schema</h2>
<p>A status effect object contains nested objects, whose key names reflect status effect IDs.</p>

<h3 class="text-monospace mt-5" id="sec-item/tag">amplifier</h3>
<hr>

<p>The <code>amplifier</code> field uses the {{ guide_link(DataSchemas\Range::class) }} to check the amplifier of the specified effect. The following checks if the amplifier is 10 or higher.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\StatusEffects::class, 'amplifier', $example_data)])

<h3 class="text-monospace mt-5" id="sec-item/tag">duration</h3>
<hr>

<p>The <code>duration</code> field uses the {{ guide_link(DataSchemas\Range::class) }} to check the remaining duration in ticks of the specified effect. The following checks if the effect has at least 15 seconds (300 ticks) remaining.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\StatusEffects::class, 'duration', $example_data)])

<h3 class="text-monospace mt-5" id="sec-item/tag">ambient</h3>
<hr>

<p>The ambient boolean checks if the effect has the "ambient" flag set to true.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\StatusEffects::class, 'ambient', $example_data)])

<h3 class="text-monospace mt-5" id="sec-item/tag">visible</h3>
<hr>

<p>The visible boolean checks if the effect has the "visible" flag set to true.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\StatusEffects::class, 'visible', $example_data)])