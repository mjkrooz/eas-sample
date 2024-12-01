@foreach(($modal_data_schemas ?? []) as $index => $modal_data_schema)
    @push('body-after')
        <div class="modal fade" id="sbModal-{{ $index }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        @if(isset($modal_title))
                            <h5 class="modal-title">{{ $modal_title }}</h5>
                        @endif
                        <div class="ml-auto">
                            <a href="{{ DataSchemas::getGuideRoute($modal_data_schema['schema']::getSlug()) }}" class="btn btn-primary">View in data schemas guide</a>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close <i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="modal-body sb-guide-modal-content">
                        <?php
                            if (isset($example_data)) {

                                $example_data->setPath($modal_data_schema['path']);
                            }
                        ?>
                        @include(guide_content_view($modal_data_schema['schema']))
                    </div>
                    <div class="modal-footer">
                        <a href="{{ DataSchemas::getGuideRoute($modal_data_schema['schema']::getSlug()) }}" class="btn btn-primary">View in data schemas guide</a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close <i class="fas fa-times"></i></button>
                    </div>
                </div>
            </div>
        </div>
    @endpush
@endforeach