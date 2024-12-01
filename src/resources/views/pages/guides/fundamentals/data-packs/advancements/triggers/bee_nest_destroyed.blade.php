@extends('sourceblock::pages.guides.fundamentals.data-packs.advancements.trigger')

@section('guide-navigation-toc')
    @include('sourceblock::chunks.menus.guides.fundamentals.toc', ['menu' => [
        'Bee nest destroyed',
        [
            'Block',
            'Item',
            'Number of bees inside'
        ]
    ]])
@endsection