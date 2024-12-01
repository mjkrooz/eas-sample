@extends('sourceblock::layouts.primary')

@section('content')
<!-- PRIMARY CONTENT -->

<div class="row mb-3">
    <div class="col-2 text-center">
        <i class="fas fa-book display-4 text-info"></i>

    </div>
    <div class="col-10">
        <h3 class="font-weight-bold">Guides</h3>
        <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae.</p>
    </div>
</div>

<hr>

<div class="jumbotron text-light p-0 shadow" style="background: url('{{ image_asset("back_dark.png") }}');background-size: cover;">
    <div style="background-color: rgba(150, 30, 150, 0.45);">
        <div class="row">
            <div class="col-md-10 p-5">
                <h1 class="display-4">Fundamentals</h1>
                <hr class="bg-ligdht" style="background:rgba(255,255,255,0.35);">
                <p class="lead">Official guides that cover the primary functionality for custom maps.</p>
            </div>
            <div class="col-md-2 p-5 d-flex justify-content-center align-items-center text-center">
                <a class="text-light stretched-link" href="{{ route('guides:fundamentals') }}"><i class="fas fa-arrow-alt-circle-right fa-5x"></i></a>
            </div>
        </div>
    </div>
</div>

<div class="jumbotron bg-dlight p-0 mt-5">
    <div class="row">
        <div class="col-md-10 p-5">
            <h1 class="display-4">User guides</h1>
            <p class="lead">Various guides created by the community that cover a wider variety of topics.</p>
        </div>
        <div class="col-md-2 p-5 d-flex justify-content-center align-items-center text-center">
            <a class="text-dark stretched-link" href="#!"><i class="far fa-arrow-alt-circle-right fa-5x"></i></a>
        </div>
    </div>
</div>

<p class="text-center font-italic">&lt;Insert popular user guides here&gt;</p>

@endsection