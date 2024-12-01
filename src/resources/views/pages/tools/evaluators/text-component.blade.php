@extends('sourceblock::layouts.primary')

@section('content')
<!-- PRIMARY CONTENT -->


    <div class="row mb-3">
        <div class="col-2 text-center">
            <i class="fas fa-comment-dots display-4 text-info"></i>
            {{-- <a href="#!" class="btn btn-block btn-lg btn-primary mt-4"><i class="fas fa-tools"></i> Back</a> --}}
        </div>
        <div class="col-10">
            <h3 class="font-weight-bold">Text Component Evaluator</h3>
            <p class="lead text-justify">Submit a text component to automatically check for structural errors.</p>
        </div>
    </div>

    <hr>

    @include('sourceblock::chunks.content.tools.evaluators.evaluator', ['label' => 'Text component', 'description' => 'Insert a text component. Structural errors and statistics will be provided, should any exist.'])
@endsection