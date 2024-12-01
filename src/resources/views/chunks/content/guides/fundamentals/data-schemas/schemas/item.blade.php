<h2 id="sec-shared-item-structure">Item schema</h2>
<p>An item object contains a handful of data to compare to an incoming item stack.</p>

<h3 class="text-monospace mt-5" id="sec-item/tag">item/tag</h3>
<hr>

<p class="font-weight-bold">You cannot use both <code>item</code> and <code>tag</code> together.</p>

<p>The <code>item</code> string specifies a base item ID to compare the item to. The following checks if the item is redstone.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Item::class, 'item', $example_data)])

<p>The <code>tag</code> string instead specifies the resource location to an ID group, minus the designating <code>#</code> character. These groups are a list of item IDs that the incoming item can match any one of. Default groups for items can be found <a href="https://github.com/Arcensoth/mcdata/tree/master/generated/data/minecraft/tags/items" target="_blank">here</a>. Adding custom groups requires the use of data packs. The following checks if the item matches any of the IDs in the "minecraft:doors" group (which checks both the "#minecraft:wooden_doors" group as well as the "minecraft:iron_door" item ID).</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Item::class, 'tag', $example_data)])

<h3 class="text-monospace mt-5" id="sec-durability">durability</h3>
<hr>

<p>The <code>durability</code> field uses the {{ guide_link(DataSchemas\Range::class) }} to check the remaining durability of an item. The following checks if the item has 400 or more durability remaining.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Item::class, 'durability', $example_data)])

<h3 class="text-monospace mt-5" id="sec-count">count</h3>
<hr>

<p>The <code>count</code> field uses the {{ guide_link(DataSchemas\Range::class) }} to check the number of items <b>in a single stack</b>. This cannot be used to check the number of items across the inventory as a whole. The following checks if the item has 16 or more in its stack.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Item::class, 'count', $example_data)])

<h3 class="text-monospace mt-5" id="sec-potion">potion</h3>
<hr>

<p>The <code>potion</code> string specifies the default brewed potion ID that the item must contain, specified in the <code>Potion</code> NBT string. The wiki contains a list of those IDs <a href="https://minecraft.gamepedia.com/Potion#Item_data" target="_blank">here</a>.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Item::class, 'potion', $example_data)])

<p><b>The item does not have to be a potion</b>. As long as the item has the <code>Potion</code> NBT string, it will match:</p>

<pre class="bg-light text-dark p-3">/give &commat;p minecraft:stone{Potion:"minecraft:invisibility"}</pre>

<h3 class="text-monospace mt-5" id="sec-enchantments">enchantments</h3>
<hr>

<p>The <code>enchantments</code> list checks the item's enchantments (whether in the <code>Enchantments</code> NBT list for all items excluding books, or the <code>StoredEnchantments</code> NBT list for only books) for matching data. If only an empty object is specified, the player's inventory is checked for <b>any</b> enchanted items.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Item::class, 'enchantments1', $example_data)])

<p>The <code>enchantment</code> string will specify the enchantment ID to look for. The following checks the item for the Sharpness enchantment.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Item::class, 'enchantments2', $example_data)])

<p>The <code>levels</code> field uses the {{ guide_link(DataSchemas\Range::class) }} to check the range of levels to find for an enchantment. The following checks if the player has any enchantments level 3 or higher.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Item::class, 'enchantments3', $example_data)])

<p>And combining it with an ID, the following checks if the player has Sharpness 5.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Item::class, 'enchantments4', $example_data)])

<h3 class="text-monospace mt-5" id="sec-nbt">nbt</h3>
<hr>

<p>The <code>nbt</code> string compares the raw NBT input to the item's NBT data. This raw data starts within the <code>tag</code> compound of the item format and must be surrounded by curly brackets. The following checks if the item has a specific display name.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Item::class, 'nbt', $example_data)])