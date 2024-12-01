@foreach($grid_menu->getData()->getData() as $data)
    <div class="row">
        <div class="col p-1">
            <a href="{{ $grid_menu->getClass()::getGuideRoute($data) }}" class="btn btn-sm btn-light w-100 shadow-sm rounded-0 @if($grid_menu->getSlug() == $data) active @endif @if($grid_menu->isMonospace()) text-monospace @endif">{{ $grid_menu->getClass()::getTranslation($data) }}</a>
        </div>
    </div>
@endforeach