@extends('sourceblock::pages.guides.fundamentals.data-packs.data-schemas.schema')

@section('guide-navigation-toc')
    @include('sourceblock::chunks.menus.guides.fundamentals.toc', ['menu' => [
        'Distance schema',
        [
            'X, Y, Z',
            'Horizontal',
            'Absolute'
        ]
    ]])
@endsection