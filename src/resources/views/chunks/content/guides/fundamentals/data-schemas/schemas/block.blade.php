<h2 id="sec-shared-item-structure">Block schema</h2>
<p>A block object contains a handful of data to compare to an incoming block.</p>

<h3 class="text-monospace mt-5" id="sec-block">block</h3>
<hr>

<p>The <code>block</code> string specifies a base block ID to detect the player in. For example, the following checks if the block has the base ID of "minecraft:tallgrass" (includes grass, fern, and double tallgrass).</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Block::class, 'block', $example_data)])

<h3 class="text-monospace mt-5" id="sec-type">tag</h3>
<hr>

<p>The <code>tag</code> string specifies a resource location to a block tag. A list of vanilla block tags can be found <a href="https://github.com/Arcensoth/mcdata/tree/master/generated/data/minecraft/tags/blocks" target="_blank">here</a>.</p>

<p>The following checks if the incoming block is any carpet.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Block::class, 'tag', $example_data)])

<h3 class="text-monospace mt-5" id="sec-type">state</h3>
<hr>

<p>The <code>state</code> object uses the {{ guide_link(DataSchemas\BlockState::class) }} to specify the block states of the incoming block. Neither the <code>block</code> nor <code>tag</code> strings have to be specified. The following condition succeeds if the block has an <code>open</code> block state of "true", which can match a variety of blocks including doors and fence gates.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Block::class, 'state', $example_data)])

<h3 class="text-monospace mt-5" id="sec-type">nbt</h3>
<hr>

<p>The <code>nbt</code> string specifies NBT data for the corresponding block entity, should it exist. The following checks if the block has an <code>Items</code> list with any item inside it, which can be true for a variety of blocks including chests and dispensers.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Block::class, 'nbt1', $example_data)])

<p>While the following only checks NBT for chests.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Block::class, 'nbt2', $example_data)])