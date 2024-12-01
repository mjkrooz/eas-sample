<h2 id="sec-shared-item-structure">Damage source schema</h2>
<p>A damage source object checks different flags and data concerning the incoming or outgoing damage.</p>

<h3 class="text-monospace mt-5" id="sec-type">bypasses_armor</h3>
<hr>

<p>Checks the "bypassArmor" flag for the incoming damage. This is true for: fire, suffocation (blocks & world border), entity cramming, drowning, starving, falling, flying into a wall, void (the Void & <code>/kill</code>), health recalcuation, magic damage, and wither effect damage. The following checks if the damage is caused by any damage that cannot be blocked.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\DamageSource::class, 'bypasses_armor', $example_data)])

<h3 class="text-monospace mt-5" id="sec-type">bypasses_invulnerability</h3>
<hr>

<p>Checks if the damage source can inflict damage on creative mode players. This is true for: void damage. The following checks if the incoming damage is not caused by the Void or <code>/kill</code>.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\DamageSource::class, 'bypasses_invulnerability', $example_data)])

<h3 class="text-monospace mt-5" id="sec-type">bypasses_magic</h3>
<hr>

<p>Checks the "bypassMagic" flag for the incoming damage. This is true for: starvation. The following checks if the player is taking starvation damage.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\DamageSource::class, 'bypasses_magic', $example_data)])

<h3 class="text-monospace mt-5" id="sec-type">is_explosion</h3>
<hr>

<p>Checks the "isExplosion" flag for the incoming damage. This is true for: creepers, ender crystals, TNT, Minecart TNT, ghast fireballs, beds, the wither, and wither skulls. The following checks if the "explosion" flag is true.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\DamageSource::class, 'is_explosion', $example_data)])

<h3 class="text-monospace mt-5" id="sec-type">is_fire</h3>
<hr>

<p>Checks the "isFire" flag for the incoming damage. This is true for: standing in a fire block, being on fire, standing on magma, standing in lava, ghast fireballs, and blaze fireballs. The following checks if the player is not taking damage from fire sources.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\DamageSource::class, 'is_fire', $example_data)])

<h3 class="text-monospace mt-5" id="sec-type">is_magic</h3>
<hr>

<p>Checks the "isMagic" flag for the incoming damage. This is true for: thorns, Instant Damage effect, Poison effect, part of Guardian laser damage, evocation fangs, and un-owned wither skulls (via <code>/summon</code>). The following checks if the incoming damage is flagged as magic damage.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\DamageSource::class, 'is_magic', $example_data)])

<h3 class="text-monospace mt-5" id="sec-type">is_projectile</h3>
<hr>

<p>Checks the "isProjectile" flag for the incoming damage. This is true for: arrows, ghast fireballs, blaze fireballs, enderpearls, eggs, snowballs, shulker bullets, and llama spit. The following checks if the incoming damage is specifically not a projectile.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\DamageSource::class, 'is_projectile', $example_data)])

<h3 class="text-monospace mt-5" id="sec-type">is_lightning</h3>
<hr>

<p>Checks the "lightning" flag for the incoming damage. This is true for: lightning bolts. The following checks if the incoming damage is specifically not from a lightning bolt.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\DamageSource::class, 'is_lightning', $example_data)])

<h3 class="text-monospace mt-5" id="sec-type">source_entity</h3>
<hr>

<p>The <code>source_entity</code> object uses the {{ guide_link(DataSchemas\Entity::class) }} to check the "owner" of the damage. For example, if the player was hit by an arrow shot by a skeleton, the skeleton would be the "source entity". The damage object already makes use of this check, so it is pointless to specify a source entity twice. This particular check is still useful for triggers that only use a damage flags object rather than a damage object.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\DamageSource::class, 'source_entity', $example_data)])

<h3 class="text-monospace mt-5" id="sec-type">direct_entity</h3>
<hr>

<p>The <code>direct_entity</code> object uses the {{ guide_link(DataSchemas\Entity::class) }} to check the direct cause of the damage. For example, if the player was hit by an arrow shot by a skeleton, the arrow would be the "direct entity". The following ensures the player was hit by an arrow shot by a skeleton.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\DamageSource::class, 'direct_entity', $example_data)])