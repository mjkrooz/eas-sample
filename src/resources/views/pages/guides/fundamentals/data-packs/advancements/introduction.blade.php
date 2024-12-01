@extends('sourceblock::layouts.guides.fundamentals.advancements')

@push('css-per')
    <style>
        .collapsing {
            -webkit-transition: none;
            transition: none;
            display: none;
        }
    </style>
@endpush

@section('guide-navigation-toc')
    @include('sourceblock::chunks.menus.guides.fundamentals.toc', ['menu' => [
        'Advancements',
        'Data packs',
        'Default advancements',
        //'/advancement'
        /*'Error handling',
        [
            'Common errors'
        ],*/
        /*'Files',
        [
            'Default files',
            'Data packs',
            [
                'Namespaces'
            ],
            'Editing'
        ]*/
    ]])
@endsection

@section('guide')
    {{-- INTRODUCTION --}}

    <img id="sec-advancements" src="{{ image_asset("guides/data-packs/advancements/banner.png") }}" class="mx-auto mb-5 d-block w-75">

    <p>Minecraft's achievements come in the form of "advancements", which are used to steer the player through the game's various features.</p>

    <p>These advancements can be customized by either overwriting the original advancements or creating your own. The primary focus point of advancements are <a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}">triggers</a>, which can be used to detect a wide variety of events, such as when the player places a block or when they kill a specific mob. The end-result of detecting these events is up to the creator; there are several options for <a href="{{ route('guides:fundamentals/data-packs/advancements/customization') }}#sec-rewards">rewards</a>, which includes running a command function, or you could go the traditional route by <a href="{{ route('guides:fundamentals/data-packs/advancements/customization') }}#sec-advancement-tree">displaying an advancement tree</a>.</p>

    <p>Advancements are data-driven using the <a href="https://www.json.org" target="_blank"><span class="sb-tooltip-underline" data-toggle="tooltip" data-placement="top" title="JavaScript Object Notation">JSON</span> format</a> and are placed in shareable <a href="https://minecraft.gamepedia.com/Tutorials/Creating_a_data_pack" target="_blank">data packs</a>.</p>

    {{-- DATA PACKS --}}

    <h2 id="sec-data-packs" class="mt-5">Data packs</h2>
    <hr>

    <div class="card bg-light text-dark shadow-sm my-4">
        <div class="card-body">
            <div class="card-text">
                <div class="row">
                    <div class="col-2 text-center d-flex justify-content-center align-items-center"><i class="fas fa-info-circle fa-4x text-success"></i></div>
                    <div class="col-10">
                        <p class="mb-0 lead">Custom advancements make use of data packs. Read the <a href="https://minecraft.gamepedia.com/Tutorials/Creating_a_data_pack" class="btdn dbtn-warning" target="_blank">data pack guide</a> to learn more about setting up a data pack. This covers file structure, file editing, and error handling.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- DEFAULT ADVANCEMENTS --}}

    <h2 id="sec-default-advancements" class="mt-5 mb-4">Default advancements</h2>
    <hr>

    @foreach($default_advancements->getData() as $category)
        <table class="table table-dark table-striped mb-0 mt-0">
            <thead class="thead-light">
                <tr>
                    <th class="text-center font-weight-bold p-0"><a data-toggle="collapse" data-target=".category-{{ $category->getName() }}" class="d-block w-100 p-3 text-dark" style="cursor: pointer;">{{ ucfirst($category->getName()) }} ({{ count($category->getData()) }})</a></th>
                </tr>
            </thead>
            <tbody class="text-monospace collapse category-{{ $category->getName() }}">
                @foreach($category->getData() as $resourceLocation)
                    <tr>
                        <td>{{ $resourceLocation->toString() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach

    {{-- /ADVANCEMENT
    
    <h2 id="sec-/advancement" class="mt-5">/advancement</h2>
    <hr>

    <p>The <code>/advancement</code> command can be used to grant or revoke advancements and individual criteria.</p> --}}

    {{-- ERROR HANDLING

    <h2 id="sec-error-handling">Error handling</h2>
    <hr>

    <p>Learning how to deal with errors is vital when working with data packs. This should be the first thing you prepare for before making a data pack. Luckily almost all typical errors are visible in the output log. While the log file (located at <code>.minecraft/logs/latest.log</code>) can be used for this, it may be favorable to use the game's built-in output log window rather than navigating to the log file.</p>

    <p>The output log window must be enabled via the Minecraft launcher, as shown below.</p>

    <img src="https://i.imgur.com/aL8XRaq.png" class="mx-auto my-3 d-block w-75">

    <h3 id="sec-common-errors">Common errors</h3>

    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis sint officia quos beatae sed voluptas neque, voluptates praesentium et accusantium!</p> --}}

    {{-- FILES

    <h3 id="sec-subheading"><a name="subheading">Subheading</a></h3>
    <p>tertert</p>
    <h3 id="sec-subheading2"><a name="subheading2">Subheading2</a></h3>
    <div style="height:400px"></div>
    <p>tertert</p>

    <h2 id="sec-files"><a name="files">Files</a></h2>

    <p>more text</p> --}}
@endsection