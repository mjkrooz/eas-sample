<h2 id="sec-shared-item-structure">Player schema</h2>
<p>Describes information regarding player entities. These options cannot be used with any entity other than a player.</p>


<h3 class="text-monospace mt-5" id="sec-item">level</h3>
<hr>

<p>The <code>level</code> field uses the {{ guide_link(DataSchemas\Range::class) }} to check the player's experience level. The following checks if the player's experience level is 30 or higher.</p>

<pre class="pre-scrollable bg-dark text-light"><code class="json px-4 py-3">"player_object": {
    "level": {
        "min": 30
    }
}</code></pre>

<h3 class="text-monospace mt-5" id="sec-item">gamemode</h3>
<hr>

<p>The <code>gamemode</code> string checks the player's gamemode. The following checks if the player is in adventure mode.</p>

<pre class="pre-scrollable bg-dark text-light"><code class="json px-4 py-3">"player_object": {
    "level": {
        "gamemode": "adventure"
    }
}</code></pre>

<h3 class="text-monospace mt-5" id="sec-item">stats</h3>
<hr>

<p>The <code>stats</code> array checks the statistics of the player.</p>

<pre class="pre-scrollable bg-dark text-light"><code class="json px-4 py-3">"player_object": {
    "stats": [

    ]
}</code></pre>

<p>Each element in the array is an object, which contains specific data:</p>

<ol>
    <li>A <code>type</code> string that specifies the statistic type. Accepted values can be found <a href="https://github.com/Arcensoth/mcdata/blob/master/processed/reports/registries/stat_type/stat_type.json" target="_blank">here</a>.</li>
    <li>A <code>stat</code> string that specifies the subtype for the statistic. The accepted values depend on the <code>type</code> specified. For example, if the type were "minecraft:custom", then the accepted values can be found <a href="https://github.com/Arcensoth/mcdata/blob/master/processed/reports/registries/custom_stat/custom_stat.json" target="_blank">here</a>.</li>
    <li>A <code>value</code> field that uses the {{ guide_link(DataSchemas\Range::class) }} to check the value of the statistic.</li>
</ol>

<p>The following checks if the player's <code>minecraft.custom:minecraft.jump</code> statistic if 50 or higher.</p>

<pre class="pre-scrollable bg-dark text-light"><code class="json px-4 py-3">"player_object": {
    "stats": [
        {
            "type": "minecraft:custom",
            "stat": "minecraft:jump",
            "value": {
                "min": 50
            }
        }
    ]
}</code></pre>

<h3 class="text-monospace mt-5" id="sec-item">recipes</h3>
<hr>

<p>The <code>recipes</code> object checks whether or not the player has unlocked specific recipes. Each field in the object is a boolean with a key corresponding to a recipe. A list of valid recipes can be found <a href="https://github.com/Arcensoth/mcdata/tree/master/generated/data/minecraft/recipes" target=_blank">here</a></p>

<p>The following checks if the player has unlocked the <code>minecraft:birch_boat</code> recipe, which is normally granted when entering water.</p>

<pre class="pre-scrollable bg-dark text-light"><code class="json px-4 py-3">"player_object": {
    "recipes": {
        "minecraft:birch_boat": true
    }
}</code></pre>



<h3 class="text-monospace mt-5" id="sec-item">advancements</h3>
<hr>

<p>The <code>advancements</code> object checks whether or not the player has unlocked specific advancements or their critiera. Each field in the object can be a boolean with a key corresponding to an advancement. The following succeeds if the player has completed the <code>minecraft:adventure/adventuring_time</code> advancement in its entirety.</p>

<pre class="pre-scrollable bg-dark text-light"><code class="json px-4 py-3">"player_object": {
    "advancements": {
        "minecraft:adventure/adventuring_time": true
    }
}</code></pre>

<p>Each field can also be an object. Within the nested object, each field's key corresponds to the advancement's criteria names and can be checked if those specific criteria were fulfilled. The following checks if the player has completed the "minecraft:badlands" criterion of the <code>minecraft:adventure/adventuring_time</code> advancement.</p>

<pre class="pre-scrollable bg-dark text-light"><code class="json px-4 py-3">"player_object": {
    "advancements": {
        "minecraft:adventure/adventuring_time": {
            "minecraft:badlands": true
        }
    }
}</code></pre>