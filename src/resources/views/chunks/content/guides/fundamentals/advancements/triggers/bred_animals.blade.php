<h2 class="text-monospace" id="sec-bred-animals"><span class="text-muted">minecraft:</span>bred_animals</h2>
<p>This triggers when the player successfully breeds two animals. If two players cause a pair of animals to breed, the animal that "births" the baby will trigger the advancement for whoever fed that animal. For example, the following succeeds if the player breeds any two animals together.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\BredAnimals::class, 'main')])

<p>There are 4 conditions for this trigger: <code><a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}#sec-player-condition">player</a></code>, <code>parent</code>, <code>partner</code>, <code>child</code>.</p>

<h3 class="text-monospace" id="sec-parent/partner">parent/partner</h3>
<hr>

<p>Both the <code>parent</code> {{ guide_link(DataSchemas\Entity::class, 0) }} and the <code>partner</code> {{ guide_link(DataSchemas\Entity::class, 1) }} describe either of the parents. Both entities in the taming process could be the parent or the partner. For example, both of the following succeeds if either parent is a cow.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\BredAnimals::class, 'parent/partner1')])

<p>A time that you'd use both parent and partner is when you want to check to see if the entity types are a specific pairing, whether it be two of the same entity or two different entities. The following will trigger only if the parents are a mix of a cow and a sheep, which cannot be fulfilled in vanilla.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\BredAnimals::class, 'parent/partner2', $example_data)])

<p>The only animal pairing that can have different parents are horses and donkeys, which create a mule. If you wanted to check if the player bred a horse and a horse together, you must specify both the parent and partner as a horse because otherwise it would trigger if the player bred a horse and a donkey.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\BredAnimals::class, 'parent/partner3', $example_data)])

<p>But if you wanted to check if a mule is being created, you'd look for a donkey and a horse (the order does not matter).</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\BredAnimals::class, 'parent/partner4', $example_data)])

<h3 class="text-monospace" id="sec-child">child</h3>
<hr>

<p>The <code>child</code> object uses the {{ guide_link(DataSchemas\Entity::class, 2) }} to check the newborn animal. The following will trigger only if the child is a cow.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\BredAnimals::class, 'child1', $example_data)])

<p>You can also specify the parents and child. For example, the following triggers if the parents include a horse and a donkey, while the child is a mule (although that makes the check for parents useless as that's the only way to get a mule).</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\BredAnimals::class, 'child2', $example_data)])

@include('sourceblock::utils.data-schema-modals', [
    'modal_title' => trans('sourceblock::App/titles.minecraft.data-schemas.meta.modal-title'),
    'modal_data_schemas' => [
        [
            'schema' => DataSchemas\Entity::class,
            'path' => 'criteria.custom_test_name.conditions.parent'
        ],
        [
            'schema' => DataSchemas\Entity::class,
            'path' => 'criteria.custom_test_name.conditions.partner'
        ],
        [
            'schema' => DataSchemas\Entity::class,
            'path' => 'criteria.custom_test_name.conditions.child'
        ]
    ]
])
