
<div class="card mb-4">
    <div class="card-body">
        <div class="card-text">{{ $message }}</div>
    </div>

    @if(!empty($contexts))
        <div class="card-footer">
            <h5 class="d-inline-block pr-3 border-right mr-3">Context</h5>
            @foreach($contexts as $contextId => $context)

                @if($context->type == 'uses_resource_location')
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal-{{$feedbackId}}-{{$messageId}}-{{$contextId}}"><i class="fas fa-info-circle"></i> {{ trans('tools::app/evaluators.feedback.context.' . $context->type) }}</button>
                @else
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal-{{$feedbackId}}-{{$messageId}}-{{$contextId}}">{{ trans('tools::app/evaluators.feedback.context.' . $context->type) }}</button>
                @endif

                @push('body-after')
                    {{-- Context Modals --}}
                <!-- Modal -->
                    <div class="modal" id="exampleModal-{{$feedbackId}}-{{$messageId}}-{{$contextId}}" tabindex="-1" aria-labelledby="exampleModalLabel-{{$feedbackId}}-{{$messageId}}-{{$contextId}}" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Context</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @include('tools::chunks.evaluators.context', ['type' => $context->type])
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                @endpush
            @endforeach
        </div>
    @endif

</div>


