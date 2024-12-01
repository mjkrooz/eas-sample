@extends('tools::layouts.evaluator', [
    'page_lead_title' => 'Text Component Evaluator',
    'page_lead_description' => 'Submit a text component to automatically check for structural errors.',
    'page_lead_icon' => 'fas fa-comment-dots'
])

@section('evaluator')
    <!-- PRIMARY CONTENT -->

{{--    @include('sourceblock::chunks.content.tools.evaluators.evaluator', ['label' => 'Text component', 'description' => 'Insert a text component. Structural errors and statistics will be provided, should any exist.'])--}}

    <form method="POST">
        @csrf
{{--        <label for="structures" class="h4 d-block">Text component</label>--}}
{{--        <p>Insert a text component. Structural errors will be provided, should any exist.</p>--}}
{{--    TODO:    <input type="hidden" name="options[debug]" value="1">--}}
        <div class="card bg-light text-dark">
            <div class="card-body">
                <textarea name="structure[]" id="structure" class="form-control text-monospace" cols="30" rows="10">{{ $raw[0] ?? '' }}</textarea>
                <div class="text-center">
                    <input type="submit" value="Evaluate" class="btn btn-success btn-block mt-3">
                </div>
            </div>
        </div>
{{--        <div class="card bg-light text-dark">--}}
{{--            <div class="card-body">--}}
{{--                <textarea name="structure[]" id="structure2" class="form-control text-monospace" cols="30" rows="10">{{ $raw[1] ?? '' }}</textarea>--}}
{{--                <div class="text-center">--}}
{{--                    <input type="submit" value="Evaluate" class="btn btn-success btn-block mt-3">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </form>

@endsection
