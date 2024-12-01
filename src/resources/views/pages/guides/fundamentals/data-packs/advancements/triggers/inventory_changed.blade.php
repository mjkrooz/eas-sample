@extends('sourceblock::pages.guides.fundamentals.data-packs.advancements.trigger')

@section('guide-navigation-toc')
    @include('sourceblock::chunks.menus.guides.fundamentals.toc', ['menu' => [
        'Inventory changed',
        [
            'Slots',
            'Items'
        ]
    ]])
@endsection