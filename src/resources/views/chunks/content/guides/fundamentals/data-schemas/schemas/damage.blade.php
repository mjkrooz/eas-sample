<h2 id="sec-shared-item-structure">Damage schema</h2>
<p>A damage object contains a large amount of information about the incoming or outgoing damage.</p>

<h3 class="text-monospace mt-5" id="sec-type">dealt</h3>
<hr>

<p>The <code>dealt</code> field uses the {{ guide_link(DataSchemas\Range::class) }} to check the raw incoming damage before damage reduction. For example, the following checks the damage of an un-owned arrow (via <code>/summon</code>) before that damage was either reduced or blocked with a shield entirely.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Damage::class, 'dealt', $example_data)])

<h3 class="text-monospace mt-5" id="sec-type">taken</h3>
<hr>

<p>The <code>taken</code> field uses the {{ guide_link(DataSchemas\Range::class) }} to check the incoming damage after damage reduction. For example, the following checks if the resulting damage after reductions was at least 5.0.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Damage::class, 'taken', $example_data)])

<h3 class="text-monospace mt-5" id="sec-type">blocked</h3>
<hr>

<p>A boolean that checks if the incoming damage was successfully blocked, provided that the <code>bypasses_armor</code> damage flag isn't true. The following checks if the player failed to block a skeleton's attack.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Damage::class, 'blocked', $example_data)])

<h3 class="text-monospace mt-5" id="sec-type">type</h3>
<hr>

<p>The <code>type</code> object uses the {{ guide_link(DataSchemas\DamageSource::class) }} to check various flags about the damage. The following checks if the damage was a projectile caused by a skeleton (though does not necessarily mean the direct cause of the damage was an arrow).</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Damage::class, 'type', $example_data)])

<h3 class="text-monospace mt-5" id="sec-type">source_entity</h3>
<hr>

<p>The <code>source_entity</code> object uses the {{ guide_link(DataSchemas\Entity::class) }} to check information about either the entity hit or the entity dealing the damage. Note that for players being the source entity, the nested type string can essentially only be <code>minecraft:player</code>. The following checks if a skeleton was at least 10 blocks away when it hit the player.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Damage::class, 'source_entity', $example_data)])