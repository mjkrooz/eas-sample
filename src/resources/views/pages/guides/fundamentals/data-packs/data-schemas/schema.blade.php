@extends('sourceblock::layouts.guides.fundamentals.data-schemas')

@section('guide')
    @include('sourceblock::chunks.content.guides.fundamentals.data-schemas.schemas.' . $grid_menu->getSlug())
@endsection