<h2 id="sec-shared-item-structure">Distance schema</h2>
<p>The distance object contains information about the distance between the advancement-earning player and an unspecified origin. The origin cannot be directly defined but changes depending on the trigger; see each trigger that uses this for specific information.</p>

<h3 class="text-monospace mt-5" id="sec-type">x, y, z</h3>
<hr>

<p>The <code>x</code>, <code>y</code>, and <code>z</code> fields all use the {{ guide_link(DataSchemas\Range::class) }} to check if the player is a number of blocks in either direction of the origin in the specified axis. You do not need to specify all of the axes. For example, the following checks if the player is within 40 blocks in either the positive or negative X direction of the origin.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Distance::class, 'xyz', $example_data)])

<h3 class="text-monospace mt-5" id="sec-type">absolute</h3>
<hr>

<p>The <code>absolute</code> field uses the {{ guide_link(DataSchemas\Range::class) }} to check if the player is within a number of blocks on all axes. You would use this instead of x/y/z if all axes are uniform. The following checks if the player is outside a 5-block range of an origin.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Distance::class, 'absolute', $example_data)])

<h3 class="text-monospace mt-5" id="sec-type">horizontal</h3>
<hr>

<p>The <code>horizontal</code> field uses the {{ guide_link(DataSchemas\Range::class) }} to check if the player is within a number of blocks on the X and Z axes, ignoring the Y axis. The following checks if the player is withn a 10-block range of an origin, but only on the X and Z axes.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Distance::class, 'horizontal', $example_data)])