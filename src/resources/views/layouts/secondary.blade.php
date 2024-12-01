@extends('sourceblock::layouts.primary') 

@section('content')
    {{--@include('sourceblock::chunks.content.primary.content-banner', ['content_banner_title' => $content_banner_title, 'content_banner_lead' => $content_banner_lead, 'content_banner_icon_class' => $content_banner_icon_class])--}}

    @yield('subcontent')
@endsection