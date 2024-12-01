@extends('sourceblock::pages.guides.fundamentals.data-packs.advancements.trigger')

@section('guide-navigation-toc')
    @include('sourceblock::chunks.menus.guides.fundamentals.toc', ['menu' => [
        'Safely harvest honey',
        [
            'Block',
            'State',
            'Item'
        ]
    ]])
@endsection