<h2>Light schema</h2>
<p>Contains information regarding light level.</p>

<h3 class="text-monospace mt-5" id="sec-type">light</h3>
<hr>
<p>The <code>light</code> field uses the {{ guide_link(DataSchemas\Range::class) }} to check the light level. This light level corresponds to either the "sky" or the "block" section seen in the F3 menu.</p>

<img id="sec-advancements" src="{{ image_asset("guides/data-packs/advancements/light_level_block.png") }}" class="mx-auto my-3 d-block w-75">

<p>The following checks if the light level is 14. Some instances of this condition succeeding includes the beginning phase of sunset/sunrise or when standing in a torch.</p>

<pre class="pre-scrollable bg-dark text-light"><code class="json px-4 py-3">"light_object": {
    "light": 14
}</code></pre>

<p>The following checks if the light level is between 0 and 7.</p>

<pre class="pre-scrollable bg-dark text-light"><code class="json px-4 py-3">"light_object": {
    "light": {
        "min": 0,
        "max": 7
    }
}</code></pre>