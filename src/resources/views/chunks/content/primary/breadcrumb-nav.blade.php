
@if (!\Request::route()->named('home'))
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-1">
            @if(isset($breadcrumb))
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-light">{{ trans('sourceblock::App/navigation.routes.home') }}</a></li>

                @for ($i = 0, $j = count($breadcrumb->getCrumbs()); $i < $j; $i++)
                    {{-- @if(!isset($breadcrumb->getCrumb($i + 1]))) --}}
                    @if($breadcrumb->isLastCrumb($breadcrumb->getCrumb($i)))
                        <li class="breadcrumb-item active">{{ $breadcrumb->getCrumb($i)->getTranslation() }}</li>
                    @else
                        <li class="breadcrumb-item"><a href="{{ $breadcrumb->getCrumb($i)->getUrl() }}" class="text-light">{{ $breadcrumb->getCrumb($i)->getTranslation() }}</a></li>
                    @endif
                @endfor
            @endif
        </ol>
    </nav>
@endif
