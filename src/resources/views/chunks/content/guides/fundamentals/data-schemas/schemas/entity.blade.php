<h2 id="sec-shared-entity-structure">Entity schema</h2>
<p>An entity object contains a handful of data to compare to an incoming entity. All options are available anywhere that this entity object is used.</p>

<h3 class="text-monospace mt-5" id="sec-location">type</h3>
<hr>

<p>The <code>type</code> string uses the {{ guide_link(DataSchemas\EntityType::class) }} to check the entity's ID. For example, the following checks if the incoming entity is a creeper.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Entity::class, 'type1', $example_data)])

<p>While the following specifies an entity tag for raiders.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Entity::class, 'type2', $example_data)])

<h3 class="text-monospace mt-5" id="sec-location">distance</h3>
<hr>

<p>The <code>distance</code> object uses the  {{ guide_link(DataSchemas\Distance::class) }} to check the distance between the advancement-earning player and an entity's origin. The following checks if the player is within 10 blocks of the entity.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Entity::class, 'distance', $example_data)])

<h3 class="text-monospace mt-5" id="sec-location">location</h3>
<hr>

<p>The <code>location</code> object uses the {{ guide_link(DataSchemas\Location::class) }} to check data concerning the entity's location in the world. The following checks if the entity is in the desert biome.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Entity::class, 'location', $example_data)])

<h3 class="text-monospace mt-5" id="sec-location">effects</h3>
<hr>

<p>The <code>effects</code> object uses the {{ guide_link(DataSchemas\StatusEffects::class) }} to check data concerning the entity's status effects. The following checks if the entity has Speed 2.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Entity::class, 'effects', $example_data)])

<h3 class="text-monospace mt-5" id="sec-location">nbt</h3>
<hr>

<p>The <code>nbt</code> string compares the raw NBT input to the entity's NBT data. This raw data starts within the root of the entity format and must be surrounded by curly brackets. If the entity being checked is a player, the <code>SelectedItem</code> compound (containing the player's mainhand item) will be appended to the player's NBT before comparing to the provided input, provided the player was holding something. The following checks if the entity has a specific tag within its <code>Tags</code> list.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Entity::class, 'nbt', $example_data)])

<h3 class="text-monospace mt-5" id="sec-location">flags</h3>
<hr>

<p>The <code>flags</code> object uses the {{ guide_link(DataSchemas\EntityFlags::class) }} to check various boolean fields that further describe the entity. The following checks if the entity is sprinting.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Entity::class, 'flags', $example_data)])

<h3 class="text-monospace mt-5" id="sec-location">equipment</h3>
<hr>

<p>The <code>equipment</code> object uses the {{ guide_link(DataSchemas\EntityEquipment::class) }} checks the items being worn and held by the entity. The following checks if there is stone in every equipment slot on the entity.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Entity::class, 'equipment', $example_data)])

<h3 class="text-monospace mt-5" id="sec-location">player</h3>
<hr>

<p>The <code>player</code> object uses the {{ guide_link(DataSchemas\Player::class) }} to check information specific to players. The following checks if the player is in creative mode.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Entity::class, 'player', $example_data)])

<h3 class="text-monospace mt-5" id="sec-location">fishing_hook</h3>
<hr>

<p>The <code>fishing_hook</code> object uses the {{ guide_link(DataSchemas\FishingHook::class) }} to check information specific to fishing hook entities. The following checks if the fishing hook is in water.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Entity::class, 'fishing_hook', $example_data)])

<h3 class="text-monospace mt-5" id="sec-location">team</h3>
<hr>

<p>The <code>team</code> string check the team the entity is in. The following checks if the entity is in the "red" team.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Entity::class, 'team', $example_data)])

<h3 class="text-monospace mt-5" id="sec-location">catType</h3>
<hr>

<p>The <code>catType</code> string takes in a resource location pointing to the texture file of the corresponding cat type. For example, the following checks if the cat is a tabby.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Entity::class, 'catType', $example_data)])