@extends('sourceblock::pages.guides.fundamentals.data-packs.advancements.trigger')

@section('guide-navigation-toc')
    @include('sourceblock::chunks.menus.guides.fundamentals.toc', ['menu' => [
        'Placed block',
        [
            'Block',
            'State',
            'Item',
            'Location'
        ]
    ]])
@endsection