{{--

    The core layout that other layouts should extend. Provides functionality for ease of extending and
    applying new parts where they should go within the layout.

--}}

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        @yield('meta')

        <!--=== TITLE ===-->

        @if(isset($subtitle))
            <title>{{ $title ?? config('app.name', 'Source Block') }} - {{ $subtitle }}</title>
        @else
            <title>{{ $title ?? config('app.name', 'Source Block') }}</title>
        @endif

        <!--=== CSS ===-->

        {{--

            CSS to be used on every single page no matter what.

        --}}

        @yield('layout_css')

        <!--=== CSS: PER-PAGE ===-->

        {{--

            Cascading yield to allow overwriting of a child layout's CSS yield.
            Essentially means that if a layout implements its own custom styles
            inline, a page yielding to "css" will overwrite that. Not too
            useful, but the option is there regardless.

        --}}

        @yield('css')

        <!--=== CSS: NESTED PER-PAGE ===-->

        {{--

            Combined yield of CSS per-page. Nested content via @include can push
            their own CSS here. This is where "assets" would put their CSS.

        --}}

        @stack('css-per')

        <!--=== JS: BEFORE ===-->

        {{--

            Javascript used on all pages no matter what, done before the body loads.

        --}}

        @yield('layout_js-before')

        <!--=== JS: BEFORE PER-PAGE ===-->

        {{--

            Combined yield of Javascript per-page. Nested content via @include can push
            their own Javascript here. This is where "assets" would put their Javascript.

            Occurs before the body loads.

        --}}

        @stack('js-before')
    </head>
    <body>

        <!--=== CONTENT ===-->

        {{--

            The primary HTML content of the page.

        --}}

        @yield('body')

        <!--=== CONTENT: AFTER ===-->

        {{--

            Content that comes between the body and javascript, such as modals.

        --}}

        @stack('body-after')

        <!--=== JS: AFTER ===-->

        {{--

            Javascript used on all pages no matter what, done after the body loads.

        --}}

        @yield('layout_js-after')

        <!--=== JS: AFTER PER-PAGE ===-->

        {{--

            Combined yield of Javascript per-page. Nested content via @include can push
            their own Javascript here. This is where "assets" would put their Javascript.

            Occurs after the body loads.

        --}}

        @stack('js-after')
    </body>
</html>
