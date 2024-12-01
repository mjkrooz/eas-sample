<h2 id="sec-shared-item-structure">Entity equipment schema</h2>
<p>Describes what the entity is wearing and holding.</p>

<h3 class="text-monospace mt-5" id="sec-item/tag">head</h3>
<hr>

<p>The <code>head</code> object uses the {{ guide_link(DataSchemas\Item::class) }} to check the head slot.</p>

<pre class="pre-scrollable bg-dark text-light"><code class="json px-4 py-3">"entity_equipment_object": {
    "head": {
        "item": "minecraft:diamond_helmet"
    }
}</code></pre>

<h3 class="text-monospace mt-5" id="sec-item/tag">chest</h3>
<hr>

<p>The <code>chest</code> object uses the {{ guide_link(DataSchemas\Item::class) }} to check the chest slot.</p>

<pre class="pre-scrollable bg-dark text-light"><code class="json px-4 py-3">"entity_equipment_object": {
    "chest": {
        "nbt": "{someData:1b}"
    }
}</code></pre>

<h3 class="text-monospace mt-5" id="sec-item/tag">legs</h3>
<hr>

<p>The <code>legs</code> object uses the {{ guide_link(DataSchemas\Item::class) }} to check the legs slot.</p>

<pre class="pre-scrollable bg-dark text-light"><code class="json px-4 py-3">"entity_equipment_object": {
    "legs": {
        "enchantments": [
            {
                "enchantment": "minecraft:protection"
            }
        ]
    }
}</code></pre>

<h3 class="text-monospace mt-5" id="sec-item/tag">feet</h3>
<hr>

<p>The <code>feet</code> object uses the {{ guide_link(DataSchemas\Item::class) }} to check the feet slot.</p>

<pre class="pre-scrollable bg-dark text-light"><code class="json px-4 py-3">"entity_equipment_object": {
    "feet": {
        "item": "minecraft:diamond_boots"
    }
}</code></pre>

<h3 class="text-monospace mt-5" id="sec-item/tag">mainhand</h3>
<hr>

<p>The <code>mainhand</code> object uses the {{ guide_link(DataSchemas\Item::class) }} to check the mainhand.</p>

<pre class="pre-scrollable bg-dark text-light"><code class="json px-4 py-3">"entity_equipment_object": {
    "mainhand": {
        "potion": "minecraft:strength"
    }
}</code></pre>

<h3 class="text-monospace mt-5" id="sec-item/tag">offhand</h3>
<hr>

<p>The <code>offhand</code> object uses the {{ guide_link(DataSchemas\Item::class) }} to check the offhand.</p>

<pre class="pre-scrollable bg-dark text-light"><code class="json px-4 py-3">"entity_equipment_object": {
    "offhand": {
        "durability": {
            "min": 400
        }
    }
}</code></pre>