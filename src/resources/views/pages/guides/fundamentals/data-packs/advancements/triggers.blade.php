@extends('sourceblock::layouts.guides.fundamentals.advancements', ['toc_float' => false])

@section('guide-navigation-toc')
    @include('sourceblock::chunks.menus.guides.fundamentals.toc', ['menu' => [
        'Triggers',
        [
            'Conditions',
            [
                'Player condition'
            ]
        ]
    ]])
@endsection

@section('guide')
    {{-- CRITERIA --}}

    <div class="card bg-light text-dark shadow-sm mb-4">
        <div class="card-body">
            <div class="card-text">
                <div class="row">
                    <div class="col-2 text-center d-flex justify-content-center align-items-center"><i class="fas fa-info-circle fa-4x text-success"></i></div>
                    <div class="col-10">
                        <p class="mb-0 lead">Select one of the triggers on the left to see its details and supported conditions.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h2 id="sec-triggers">Triggers</h2>
    <hr>

    <p>A trigger is effectively an event listener. When certain events happen in-game, they can activate the trigger. For example, sleeping in a bed will activate all instances of the <code>minecraft:slept_in_bed</code> trigger, potentially fulfilling advancement criteria.</p>

    @include('sourceblock::chunks.json-code-block', ['code' => '{
    "criteria": {
        "custom_test_name": {
            "trigger": "minecraft:slept_in_bed"
        }
    }
}'])

    <h3 id="sec-conditions">Conditions</h3>

    <p>Many advancements have extra options you can provide to narrow down exactly what you want to detect. These extra conditions are placed within the <code>conditions</code> object.</p>

    <p>For example, the <code>minecraft:consume_item</code> trigger would normally activate when the player eats any item, but a condition can be added to restrict the item to an apple. Thus the following can only be fulfilled if the player eats an apple.</p>

    @include('sourceblock::chunks.json-code-block', ['code' => '{
    "criteria": {
        "custom_test_name": {
            "trigger": "minecraft:consume_item",
            "conditions": {
                "item": {
                    "item": "minecraft:apple"
                }
            }
        }
    }
}'])

    <p>Since many advancements share the same JSON structure for conditions, those data structures have been abstracted as <a href="{{ route('guides:fundamentals/data-packs/data-schemas') }}">data schemas</a>, which are also used by other features such as <a href="#!">predicates</a>.</p>

    <h4 id="sec-player-condition">Player condition</h4>

    <p>Nearly all triggers can check the player that activated the trigger by using the <code>player</code> {{ guide_link(DataSchemas\Entity::class, 0) }}.</p>

    <p>All triggers support the player condition <b>except</b> for the following:</p>

    <ul>
        <li>The <a href="{{ route('guides:fundamentals/data-packs/advancements/trigger', 'impossible') }}">impossible</a> trigger, <a href="https://www.minecraft.net/en-us/article/minecraft-snapshot-20w18a" target="_blank">by design</a>.</li>
        <li>The <a href="{{ route('guides:fundamentals/data-packs/advancements/trigger', 'tick') }}">tick</a> trigger, due to a bug (<a href="https://bugs.mojang.com/browse/MC-181630" target="_blank">MC-181630</a>).</li>
    </ul>

    @include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\BredAnimals::class, 'player', $example_data)])
@endsection

@include('sourceblock::utils.data-schema-modals', [
    'modal_title' => trans('sourceblock::App/titles.minecraft.data-schemas.meta.modal-title'),
    'modal_data_schemas' => [
        [
            'schema' => DataSchemas\Entity::class,
            'path' => 'criteria.custom_test_name.conditions.player'
        ]
    ]
])
