<nav class="nav nav-tabs nav-justified">
    @foreach ($menu as $item)
        @if(\Request::route()->named($item) || (isset($breadcrumb) && $item === $breadcrumb->getLastCrumb()->getName()))
            <a class="nav-item nav-link active bg-primary text-light rounded-0 border-0" href="{{ route($item) }}">{{ trans('sourceblock::App/navigation.routes.' . $item) }}</a>
        @else
            <a class="nav-item nav-link" href="{{ route($item) }}">{{ trans('sourceblock::App/navigation.routes.' . $item) }}</a>
        @endif
    @endforeach
</nav>
