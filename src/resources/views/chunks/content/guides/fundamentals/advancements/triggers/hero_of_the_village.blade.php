<h2 class="text-monospace" id="sec-hero-of-the-village"><span class="text-muted">minecraft:</span>hero_of_the_village</h2>
<p>This triggers when a pillager raid that the player participated in (by killing a member of the raid) was vanquished.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\HeroOfTheVillage::class, 'main')])

<p>This trigger uses only the {{ guide_link(DataSchemas\Location::class, 0) }} to check various data and the <code><a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}#sec-player-condition">player</a></code> condition. The origin of the location is the player's coordinates.</p>

<p>For example, the following only succeeds if the player was in a desert biome when the raid was vanquished.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\HeroOfTheVillage::class, 'location', $example_data)])

@include('sourceblock::utils.data-schema-modals', [
    'modal_title' => trans('sourceblock::App/titles.minecraft.data-schemas.meta.modal-title'),
    'modal_data_schemas' => [
        [
            'schema' => DataSchemas\Location::class,
            'path' => 'criteria.custom_test_name.conditions'
        ]
    ]
])
