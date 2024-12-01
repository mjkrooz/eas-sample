@extends('sourceblock::pages.guides.fundamentals.data-packs.advancements.trigger')

@section('guide-navigation-toc')
    @include('sourceblock::chunks.menus.guides.fundamentals.toc', ['menu' => [
        'Killed by crossbow',
        [
            'Victims',
            'Unique entity types'
        ]
    ]])
@endsection