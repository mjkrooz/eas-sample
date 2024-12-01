<h2 id="sec-shared-item-structure">Fluid schema</h2>
<p>A fluid object contains a handful of data to compare to an incoming fluid.</p>

<h3 class="text-monospace mt-5" id="sec-type">fluid</h3>
<hr>

<p>The <code>fluid</code> string specifies a base fluid ID to detect the player in. A list of accepted values can be found <a href="https://github.com/Arcensoth/mcdata/blob/master/processed/reports/registries/fluid/fluid.json" target="_blank">here</a>.</p>
    
<p>The following checks if the fluid has the base ID of "minecraft:water".</p>

<pre class="pre-scrollable bg-dark text-light"><code class="json px-4 py-3">"fluid_object": {
    "fluid": "minecraft:water"
}</code></pre>

<h3 class="text-monospace mt-5" id="sec-type">tag</h3>
<hr>

<p>The <code>tag</code> string specifies a resource location to a fluid tag. A list of vanilla fluid tags can be found <a href="https://github.com/Arcensoth/mcdata/tree/master/generated/data/minecraft/tags/fluids" target="_blank">here</a>.</p>

<p>The following checks if the incoming fluid is any lava fluid.</p>

<pre class="pre-scrollable bg-dark text-light"><code class="json px-4 py-3">"fluid_object": {
    "tag": "minecraft:lava"
}</code></pre>

<h3 class="text-monospace mt-5" id="sec-type">state</h3>
<hr>

<p>The <code>state</code> object uses the {{ guide_link(DataSchemas\BlockState::class) }} to check the block states of the incoming fluid. Neither the <code>fluid</code> nor <code>tag</code> strings have to be specified. The following condition succeeds if the fluid has an <code>level</code> block state of 1.</p>

<pre class="pre-scrollable bg-dark text-light"><code class="json px-4 py-3">"fluid_object": {
    "state": {
        "level": 1
    }
}</code></pre>