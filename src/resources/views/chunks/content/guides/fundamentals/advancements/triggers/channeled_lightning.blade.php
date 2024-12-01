<h2 class="text-monospace" id="sec-channeled-lightning"><span class="text-muted">minecraft:</span>channeled_lightning</h2>
<p>This triggers when a lightning bolt summoned from the Channeling enchantment strikes an entity.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\ChanneledLightning::class, 'main')])

<p>There are 2 conditions for this trigger: <code><a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}#sec-player-condition">player</a></code>, <code>victims</code>.</p>

<h3 class="text-monospace" id="sec-victims">victims</h3>
<hr>

<p>The <code>victims</code> list contains objects that use the {{ guide_link(DataSchemas\Entity::class, 0) }} to detail the type of entities that must be struck in order for the advancement to be fulfilled.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\ChanneledLightning::class, 'victims1', $example_data)])

<p>If multiple entities are specified, the lightning bolt must strike all of the specified entities. For example, the following will succeed if both a creeper and a zombie were struck by the same Channeled lightning bolt, but will fail if only one or the other were struck.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\ChanneledLightning::class, 'victims2', $example_data)])

<p>If the same entity is specified multiple times, then the lightning bolt must strike as many of that entity as is specified. For example, the following will only succeed if the lightning bolt struck 2 individual creepers.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\ChanneledLightning::class, 'victims3', $example_data)])

@include('sourceblock::utils.data-schema-modals', [
    'modal_title' => trans('sourceblock::App/titles.minecraft.data-schemas.meta.modal-title'),
    'modal_data_schemas' => [
        [
            'schema' => DataSchemas\Entity::class,
            'path' => 'criteria.custom_test_name.conditions.victims[]'
        ]
    ]
])
