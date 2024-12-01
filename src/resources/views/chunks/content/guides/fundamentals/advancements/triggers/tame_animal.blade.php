<h2 class="text-monospace" id="sec-tame-animal"><span class="text-muted">minecraft:</span>tame_animal</h2>
<p>This triggers when the player tames any animal.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\TameAnimal::class, 'main')])

<p>There are 2 conditions for this trigger: <code><a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}#sec-player-condition">player</a></code>, <code>entity</code>.</p>

<h3 class="text-monospace" id="sec-entity">entity</h3>
<hr>

<p>The <code>entity</code> object uses the {{ guide_link(DataSchemas\Entity::class, 0) }} to check the entity that the player tamed. The following checks if the player tamed a wolf.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\TameAnimal::class, 'entity', $example_data)])

@include('sourceblock::utils.data-schema-modals', [
    'modal_title' => trans('sourceblock::App/titles.minecraft.data-schemas.meta.modal-title'),
    'modal_data_schemas' => [
        [
            'schema' => DataSchemas\Entity::class,
            'path' => 'criteria.custom_test_name.conditions.entity'
        ]
    ]
])
