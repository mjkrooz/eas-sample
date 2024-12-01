<h2 id="sec-shared-item-structure">Fishing hook schema</h2>
<p>Checks data for a fishing hook. Does not work if the entity is not a fishing hook.</p>

<h3 class="text-monospace mt-5" id="sec-item">in_open_water</h3>
<hr>

<p>The <code>in_open_water</code> boolean checks whether or not the fishing hook is in water, as opposed to being hooked to a block or entity. The following checks if the fishing hook is in a block or entity.</p>

<pre class="pre-scrollable bg-dark text-light"><code class="json px-4 py-3">"fishing_hook_object": {
    "in_open_water": false
}</code></pre>