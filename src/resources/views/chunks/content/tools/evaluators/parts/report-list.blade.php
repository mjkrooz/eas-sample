@foreach ($list as $itemID => $item)

    <div id="itemList_{{ $id }}" class="row mb-3 pt-1">
        <div class="col">
            <div class="card bg-light">
                <div class="card-body">
                    {!! $item->buildMessage() !!}
                </div>
                <div class="card-footer p-0 border-radius-0">
                    @if ($reportType === 'fatal')
                        <a href="#itemList_{{ $id }}_Code_{{ $itemID }}_{{ $reportType }}" class="btn btn-block btn-sm btn-danger rounded-0" data-parent="#itemList_{{ $id }}" data-toggle="collapse">Show code</a>
                    @elseif ($reportType === 'warning')
                        <a href="#itemList_{{ $id }}_Code_{{ $itemID }}_{{ $reportType }}" class="btn btn-block btn-sm btn-warning rounded-0" data-parent="#itemList_{{ $id }}" data-toggle="collapse">Show code</a>
                    @else
                        <a href="#itemList_{{ $id }}_Code_{{ $itemID }}_{{ $reportType }}" class="btn btn-block btn-sm btn-info rounded-0" data-parent="#itemList_{{ $id }}" data-toggle="collapse">Show code</a>
                    @endif
                    <div id="itemList_{{ $id }}_Code_{{ $itemID }}_{{ $reportType }}" class="collapse">
                        <pre class="p-0 border-0 json m-0" style="max-height: 20rem;overflow-y: scroll;"><code>{{ $item->getJson()->toJsonString(true) }}</code></pre>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endforeach