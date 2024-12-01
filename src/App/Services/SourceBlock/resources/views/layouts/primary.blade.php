@extends('sourceblock::layouts.core', ['title' => trans('sourceblock::app/main.title')])

{{-- Meta tags that appear in the head but before the title. --}}

@section('meta')
    {{-- TODO: CSRF: not necessary? Where did this even come from originally? Looks like it came from Brad. Will research later. --}}

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>window.Laravel = {csrfToken: '{{ csrf_token() }}'};</script>
@endsection

{{-- CSS that appears in the head but after the title. --}}

@section('layout_css')
    @include('sourceblock::primary.assets.css.main-css')
@endsection

{{-- JavaScript that appears in the head before the body begins. --}}

@section('layout_js-before')

@endsection

{{-- The body, containing standardized navigation, footers, and a dynamic body that changes per page. --}}

@section('body')

    <!-- Notification bar -->

    @include('sourceblock::primary.notice-bar')

    <!-- Main Navigation -->

    @include('sourceblock::primary.navs.top-nav')

    <!-- PRIMARY CONTENT -->

    <div class="container my-0">

        @yield('content')

    </div>

    <!-- Footer Navigation -->

    @include('sourceblock::primary.footer')

    <!-- Copyright -->

    @include('sourceblock::primary.copyright')

@endsection

{{-- JavaScript that appears at the end of the body, after the content, but before the body closes. --}}

@section('layout_js-after')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection
