@extends('sourceblock::layouts.primary.page_lead')

@push('css-per')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.8/styles/atom-one-dark.min.css">

    <style>
        .sb-edition-selector a:first-child {
            border-top-left-radius: 25px !important;
            border-bottom-left-radius: 25px !important;
        }

        .sb-edition-selector a:last-child {
            border-top-right-radius: 25px !important;
            border-bottom-right-radius: 25px !important;
        }
    </style>
@endpush

@section('sub-content')
    @yield('evaluator')

    @if(!empty($evaluations) && isset($evaluations[0]->getOutput()['feedback']))

{{--        {{ print_r($evaluations) }}--}}

        <div class="mt-4">
            @include('tools::chunks.evaluators.feedback', ['passes' => $evaluations[0]->getOutput()['passes'], 'feedback' => $evaluations[0]->getOutput()['feedback']])
        </div>


{{--        <div class="row mt-3">--}}
{{--            <div class="col">--}}
{{--                <div class="accordion my-4" id="reportList">--}}
{{--                    <form method="post">--}}
{{--                        @csrf--}}
{{--                        @include('tools::chunks.evaluators.report', ['reports' => $evaluations[0]['feedback']])--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    @endif
@endsection
