@extends('sourceblock::layouts.guides.fundamentals.data-schemas')

@section('guide-navigation-toc')
    @include('sourceblock::chunks.menus.guides.fundamentals.toc', ['menu' => [
        'Data schemas',
        /*'Error handling',
        [
            'Common errors'
        ],
        'Files',
        [
            'Default files',
            'Data packs',
            [
                'Namespaces'
            ],
            'Editing'
        ]*/
    ]])
@endsection

@section('guide')
    {{-- INTRODUCTION --}}

    <!-- <img id="sec-advancements" src="{{ image_asset("guides/data-packs/data-schemas/banner.png") }}" class="mx-auto my-3 d-block w-75"> -->
        
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus maiores vel aperiam vitae? Neque aliquam aperiam tempore ducimus dicta. Voluptate, error! Ad tenetur odit unde reiciendis sapiente voluptate natus optio veritatis officiis quasi nemo at obcaecati molestiae fugit aliquid id qui, laudantium fugiat dolorem dolore praesentium illo quaerat distinctio? Quibusdam quos nemo dolorem molestiae, animi corporis molestias ducimus voluptates deserunt.</p>

    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Vero recusandae voluptate similique quasi voluptatem perferendis necessitatibus, nobis repellat, et eius blanditiis iure placeat quaerat sapiente cum consectetur inventore nam sunt unde, culpa maiores esse sed itaque. Labore atque laudantium assumenda.</p>

    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cupiditate, doloremque eius illum voluptatibus esse maxime.</p>
@endsection