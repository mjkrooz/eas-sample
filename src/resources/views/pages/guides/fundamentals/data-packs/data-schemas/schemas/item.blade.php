@extends('sourceblock::pages.guides.fundamentals.data-packs.data-schemas.schema')

@section('guide-navigation-toc')
    @include('sourceblock::chunks.menus.guides.fundamentals.toc', ['menu' => [
        'Item schema',
        [
            'Item/tag',
            'Durability',
            'Count',
            'Potion',
            'Enchantments',
            'NBT'
        ]
    ]])
@endsection