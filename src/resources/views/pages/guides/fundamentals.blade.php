@extends('sourceblock::layouts.primary')

@section('content')
<!-- PRIMARY CONTENT -->

<div class="row mb-3">
    <div class="col-2 text-center">
        <i class="fas fa-book display-4 text-info"></i>

    </div>
    <div class="col-10">
        <h3 class="font-weight-bold">Fundamental guides</h3>
        <p class="lead">In-depth tutorials for a variety of topics relating to Minecraft commands and map-making.</p>
    </div>
</div>

<hr>

<div class="card-deck">
    <div class="card shadow-sm">
        <div class="card-header bg-dark border-0">
            <h4 class="text-center"><a href="{{ route('guides:fundamentals/data-packs') }}" class="text-light stretched-link">Data packs</a></h4>
        </div>
        <div class="row no-gutters">
            <div class="col-md-8">
                <div class="card-body">
                    <p class="card-text text-justify">Data packs enhance core functionality of the game through a variety of data-driven features and commands.</p>
                </div>
            </div>
            <div class="col-md-4 d-flex justify-content-center align-items-center">
                <div class="text-center">
                    <i class="fas fa-file-code text-dark fa-4x"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-success border-0">
            <h4 class="text-center"><a href="#!" class="text-light stretched-link">Resource packs</a></h4>
        </div>
        <div class="row no-gutters">
            <div class="col-md-8">
                <div class="card-body">
                    <p class="card-text text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem repudiandae molestias laudantium?</p>
                </div>
            </div>
            <div class="col-md-4 d-flex justify-content-center align-items-center">
                <div class="text-center">
                    <i class="fas fa-brush text-dark fa-4x"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-danger border-0">
            <h4 class="text-center"><a href="#!" class="text-light stretched-link">A third kind of pack</a></h4>
        </div>
        <div class="row no-gutters">
            <div class="col-md-8">
                <div class="card-body">
                    <p class="card-text text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, at reprehenderit quas optio nulla ipsa architecto eos eius qui?</p>
                </div>
            </div>
            <div class="col-md-4 d-flex justify-content-center align-items-center">
                <div class="text-center">
                    <i class="fas fa-poop text-dark fa-4x"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<hr>

<div class="row mb-4">
    <div class="col-md-6">
            <img id="sec-advancements" src="{{ image_asset("guides/data-packs/data-schemas/banner.png") }}" class="mx-auto my-3 d-block w-100" style="position: relative;z-index: 2;">
        <div class="card" style="position: relative;top: -30px;z-index: 1;">

            <div class="card-body text-center pt-4">
                <h5 class="card-title"><a class="stretched-link" href="{{ route('guides:fundamentals/data-packs/advancements') }}">Text components</a></h5>
                <p class="card-text">
                    The technical side of text in Minecraft. A JSON structure is used to specify numerous options for text, ranging from color to click events.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection