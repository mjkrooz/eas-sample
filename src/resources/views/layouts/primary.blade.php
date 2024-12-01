@extends('layouts.root')

@section('body')

    <!-- Main Navigation -->

    @include('chunks.content.primary.main-nav')

    <!-- PRIMARY CONTENT -->

    <div class="container my-0">

        @yield('content')

    </div>

    <!-- Footer Navigation -->

    @include('chunks.content.primary.footer-nav')

    <!-- Copyright -->

    @include('chunks.content.primary.copyright')

@endsection
