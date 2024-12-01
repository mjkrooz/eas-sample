<h2 class="text-monospace" id="sec-brewed-potion"><span class="text-muted">minecraft:</span>brewed_potion</h2>
<p>This triggers when the player removes any item from the output slots of a brewing stand. Note that this doesn't mean the player has to have brewed it; any brewing stands that generate with potions inside it (such as in the End Ship) will fulfill this trigger. The player can repeatedly place a potion into a brewing stand and remove it to continuously fulfill this trigger.</p>

<p>For example, the following will trigger if the player removes any item from a brewing stand:</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\BrewedPotion::class, 'main')])

<p>There are 2 conditions for this trigger: <code><a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}#sec-player-condition">player</a></code>, <code>potion</code>.</p>

<h3 class="text-monospace" id="sec-potion">potion</h3>
<hr>

<p>The <code>potion</code> string allows you to specify a default brewed potion ID (stored in the <code>Potion</code> string tag on the item) that the removed item must contain. A list of brewed potion IDs can be found <a href="https://github.com/Arcensoth/mcdata/blob/master/processed/reports/registries/potion/potion.json" target="_blank">here</a>. If the item removed does not have a Potion string tag, the trigger will assume the ID is "minecraft:empty".</p>

<p>The following only triggers if the player removes an extended Invisibility potion from the brewing stand's output slots.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\BrewedPotion::class, 'potion', $example_data)])