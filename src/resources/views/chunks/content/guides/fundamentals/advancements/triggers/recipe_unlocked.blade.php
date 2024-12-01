<h2 class="text-monospace" id="sec-recipe-unlocked"><span class="text-muted">minecraft:</span>recipe_unlocked</h2>
<p>This triggers when the player unlocks a recipe. There is 1 <b>required</b> condition for this trigger: <code>recipe</code>, which is a string that specifies the resource location to the desired recipe that must be unlocked. Note that this check only occurs at the time of receiving the recipe; if the player unlocked it before the advancement exists, the advancement will not take that into consideration. As the recipe is only detected at the moment of unlocking it, you must revoke the recipe from the player using the <code>/recipe</code> command before it can be detected again.</p>

<p>The following will trigger when the player unlocks the <code>minecraft:redstone</code> recipe, in whatever way they unlock it (including as a reward for another advancement).</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\RecipeUnlocked::class, 'main')])

<p>There is 1 optional condition for this trigger: <code><a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}#sec-player-condition">player</a></code>.</p>