@extends('sourceblock::layouts.primary')

@section('content')
<!-- PRIMARY CONTENT -->


    <div class="row mb-3">
        <div class="col-2 text-center">
            <i class="fas fa-cubes display-4 text-info"></i>
            {{-- <a href="#!" class="btn btn-block btn-lg btn-primary mt-4"><i class="fas fa-tools"></i> Back</a> --}}
        </div>
        <div class="col-10">
            <h3 class="font-weight-bold">pack.mcmeta Evaluator</h3>
            <p class="lead text-justify">Submit a pack.mcmeta to automatically check for structural errors.</p>
        </div>
    </div>

    <hr>

    @include('sourceblock::chunks.content.tools.evaluators.evaluator', ['label' => 'pack.mcmeta', 'description' => 'Insert a pack.mcmeta. Structural errors and statistics will be provided, should any exist.'])
@endsection