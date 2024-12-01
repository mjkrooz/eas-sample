<h2 id="sec-shared-item-structure">Location schema</h2>
<p>A location object contains a small amount of data to specify an origin, biome, or generated structure.</p>

<h3 class="text-monospace mt-5" id="sec-type">position</h3>
<hr>

<p>The <code>position</code> object contains <code>x</code>, <code>y</code>, and <code>z</code> fields, which use the {{ guide_link(DataSchemas\Range::class) }} to check the global position of the player in the world. You do not need to specify all of the axes. For example, the following checks if the player is at Y62 or lower.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Location::class, 'position', $example_data)])

<h3 class="text-monospace mt-5" id="sec-type">biome</h3>
<hr>

<p>The <code>biome</code> string specifies the name ID of the biome that the player must stand within. You can find a list of name IDs for biomes here. A list of accepted values can be found <a href="https://github.com/Arcensoth/mcdata/blob/master/processed/reports/registries/biome/biome.json" target="_blank">here</a>.</p>

<p>The following checks if the player has visited the <code>minecraft:desert</code> biome.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Location::class, 'biome', $example_data)])

<h3 class="text-monospace mt-5" id="sec-type">feature</h3>
<hr>

<p>The <code>feature</code> string specifies the name ID of a structure. The player must be standing within the bounding box of that structure to be detected. A list of accepted values can be found <a href="https://github.com/Arcensoth/mcdata/blob/master/processed/reports/registries/feature/feature.json" target="_blank">here</a>.</p>

<p>The following checks if the player is inside an "endcity" structure.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Location::class, 'feature', $example_data)])

<h3 class="text-monospace mt-5" id="sec-type">dimension</h3>
<hr>

<p>The <code>dimension</code> string specifies the name ID of a dimension to find the player in. A list of accepted values can be found <a href="https://github.com/Arcensoth/mcdata/blob/master/processed/reports/registries/dimension_type/dimension_type.json" target="_blank">here</a>.</p>

<p>The following checks if the player is anywhere in the nether.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Location::class, 'dimension', $example_data)])

<h3 class="text-monospace mt-5" id="sec-type">light</h3>
<hr>

<p>The <code>light</code> object uses the {{ guide_link(DataSchemas\Light::class) }} to check the light level at the current location. The following checks if the light level if 15.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Location::class, 'light', $example_data)])

<h3 class="text-monospace mt-5" id="sec-type">block</h3>
<hr>

<p>The <code>block</code> object uses the {{ guide_link(DataSchemas\Block::class) }} to check the block at the current location. The following checks if the block is redstone with a power level of 1.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Location::class, 'block', $example_data)])

<h3 class="text-monospace mt-5" id="sec-type">fluid</h3>
<hr>

<p>The <code>fluid</code> object uses the {{ guide_link(DataSchemas\Fluid::class) }} to check the fluid at the current location. The following checks if the block is water with a level of 1.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Location::class, 'fluid', $example_data)])