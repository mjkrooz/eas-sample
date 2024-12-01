@if($index === null)
    <span data-toggle="tooltip" data-placement="top" title="Go to data schema">
        <a class="btn btn-sm btn-outline-dark sb-guide-link" href="{{ $guide->getGuideRoute() }}""><i class="fas fa-code"></i> {{ strtolower(trans('sourceblock::App/titles.minecraft.data-schemas.' . $guide::getSlug())) }} schema</a>
    </span>
@else
    <span data-toggle="tooltip" data-placement="top" title="Show data schema">
        <a class="btn btn-sm btn-outline-dark sb-guide-link" href="{{ $guide->getGuideRoute() }}" data-toggle="modal" data-target="#sbModal-{{ $index }}"><i class="fas fa-code"></i> {{ strtolower(trans('sourceblock::App/titles.minecraft.data-schemas.' . $guide::getSlug())) }} schema</a>
    </span>
@endif
