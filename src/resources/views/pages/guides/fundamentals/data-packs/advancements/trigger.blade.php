@extends('sourceblock::layouts.guides.fundamentals.advancements', ['toc_float' => true])

@section('guide')
    @include('sourceblock::chunks.content.guides.fundamentals.advancements.triggers.' . $grid_menu->getSlug())
@endsection