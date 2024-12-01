@extends('sourceblock::layouts.primary')

@section('content')
<!-- PRIMARY CONTENT -->

<div class="row mb-3">
    <div class="col-2 text-center">
        <i class="fas fa-file-code display-4 text-info"></i>

    </div>
    <div class="col-10">
        <h3 class="font-weight-bold">Data packs</h3>
        <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed dicta nobis qui, corporis nisi cupiditate.</p>
    </div>
</div>

<hr>

<div class="row mb-4">
    <div class="col-md-6">
            <img id="sec-advancements" src="{{ image_asset("guides/data-packs/data-schemas/banner.png") }}" class="mx-auto my-3 d-block w-100" style="position: relative;z-index: 2;">
        <div class="card" style="position: relative;top: -30px;z-index: 1;">

            <div class="card-body text-center pt-4">
                <h5 class="card-title"><a class="tedxt-warning" href="{{ route('guides:fundamentals/data-packs/data-schemas') }}">JSON data schemas</a></h5>
                <p class="card-text">
                    A collection of standardized JSON structures used by different features, including advancement triggers and predicates.
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
            <img id="sec-advancements" src="{{ image_asset("guides/data-packs/predicates/banner.png") }}" class="mx-auto my-3 d-block w-100" style="position: relative;z-index: 2;">
        <div class="card" style="position: relative;top: -30px;z-index: 1;">

            <div class="card-body text-center pt-4">
                <h5 class="card-title"><a class="tedxt-warning" href="{{ route('guides:fundamentals/data-packs/advancements') }}">Predicates</a></h5>
                <p class="card-text">
                    Predicates compare incoming data with a data schema and state whether or not they match.
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6">
            <img id="sec-advancements" src="{{ image_asset("guides/data-packs/advancements/banner.png") }}" class="mx-auto my-3 d-block w-100" style="position: relative;z-index: 2;">
        <div class="card" style="position: relative;top: -30px;z-index: 1;">

            <div class="card-body text-center pt-4">
                <h5 class="card-title"><a class="tedxt-warning" href="{{ route('guides:fundamentals/data-packs/advancements') }}">Advancements</a></h5>
                <p class="card-text">
                    Minecraft's data-driven achievement system.
                </p>
            </div>
        </div>
    </div>
</div>
{{-- <div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><a href="#!">Recipes</a></h5>
                <p class="card-text">
                    A guide to creating custom recipes.
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><a href="#!">Loot tables</a></h5>
                <p class="card-text">A guide to creating custom loot tables.</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><a href="#!">Text component</a></h5>
                <p class="card-text">
                    A guide to Minecraft's JSON text component.
                </p>
            </div>
        </div>
    </div>
</div> --}}
@endsection