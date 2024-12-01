<h2>Entity type schema</h2>
<p>The <code>type</code> string specifies the entity ID to match against. For example, the following checks if the incoming entity is a creeper.</p>

<pre class="pre-scrollable bg-dark text-light"><code class="json px-4 py-3">"type": "minecraft:creeper"</code></pre>

<p>It also specifies an entity tag when the resource location is preceded by a <code>#</code></p>

<pre class="pre-scrollable bg-dark text-light"><code class="json px-4 py-3">"type": "#minecraft:raiders"</code></pre>