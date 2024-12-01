
@push('css-per')
    <style>
        .sb-edition-selector a:first-child {
            border-top-left-radius: 25px !important;
            border-bottom-left-radius: 25px !important;
        }

        .sb-evaluation-tabs .active {
            background-color: #dadada;
            border-color: #dadada;
            color: #000000;
        }
    </style>
@endpush
<div class="row">
    <div class="col-3">
        <div class="row col">
            <div class="col">
            </div>
        </div>

        {{-- Feedback Tab Menu --}}

        <div class="sb-evaluation-tabs list-group nav-tabs" role="tablist">

            {{-- Tab Menu Title --}}

            @if($passes && empty($feedback['warning']))
                <h3 class="bg-success text-light p-3 rounded"><i class="fas fa-check-square text-light"></i> Feedback</h3>
            @elseif(!empty($feedback['fatal']))
                <h3 class="bg-danger text-light p-3 rounded"><i class="fas fa-times-circle text-light"></i> Feedback</h3>
            @elseif(!empty($feedback['error']))
                <h3 class="bg-warning text-dark p-3 rounded"><i class="fas fa-times-circle text-dark"></i> Feedback</h3>
            @elseif(!empty($feedback['warning']))
                <h3 class="bg-info text-light p-3 rounded"><i class="fas fa-exclamation-circle text-light"></i> Feedback</h3>
            @else
                <h3 class="bg-success text-light p-3 rounded"><i class="fas fa-exclamation-circle text-light"></i> Feedback</h3>
            @endif

            {{-- Tab Menu Debug (when available) --}}

            @if($options->getOption(\App\Domains\Minecraft\Tools\ToolOptions::DEBUG))
                <a class="list-group-item nav-item border-top{{ (empty($feedback['debug']) ? ' disabled' : '') }}" id="evaluationFeedbackTabDebug-link" data-toggle="tab" aria-current="page" href="#evaluationFeedbackTabDebug" role="tab" aria-controls="evaluationFeedbackTabDebug">Debug ({{ count($feedback['debug']) }})</a>
            @endif

            {{-- Tab Menu Links --}}
{{--            <a class="nav-link" id="evaluationReportTabRaw_{{ $id }}-link" data-toggle="tab" href="#evaluationReportTabRaw_{{ $id }}" role="tab" aria-controls="evaluationReportTabRaw_{{ $id }}" aria-selected="false">Raw</a>--}}

            <a class="list-group-item nav-item border-top{{ (empty($feedback['warning']) ? ' disabled' : '') }}{{ (empty($feedback['fatal']) && empty($feedback['error']) && !empty($feedback['warning'])) ? ' active' : '' }}" id="evaluationFeedbackTabWarning-link" data-toggle="tab" aria-current="page" href="#evaluationFeedbackTabWarning" role="tab" aria-controls="evaluationFeedbackTabWarning">Warnings ({{ count($feedback['warning']) }})</a>
            <a class="list-group-item nav-item border-top{{ (empty($feedback['error']) ? ' disabled' : '') }}{{ (empty($feedback['fatal']) && !empty($feedback['error'])) ? ' active' : '' }}" id="evaluationFeedbackTabError-link" data-toggle="tab" aria-current="page" href="#evaluationFeedbackTabError" role="tab", aria-controls="evaluationFeedbackTabError">Errors ({{ count($feedback['error']) }})</a>
            <a class="list-group-item nav-item border-top{{ (empty($feedback['fatal']) ? ' disabled' : '') }}{{ (!empty($feedback['fatal'])) ? ' active' : '' }}" id="evaluationFeedbackTabFatal-link" data-toggle="tab" aria-current="page" href="#evaluationFeedbackTabFatal" role="tab", aria-controls="evaluationFeedbackTabFatal">Fatals ({{ count($feedback['fatal']) }})</a>
        </div>
    </div>

    <div class="col-9 tab-content">

        {{-- Feedback Display Panel --}}
        <div class="mb-5">
            @if($passes && empty($feedback['warning']))
                <p class="h5">Your text component is perfectly correct!</p>
            @elseif(!empty($feedback['fatal']))
                <p class="h5">Your text component ran into a fatal issue that prevented the evaluator from working. All fatal issues must be fixed before a detailed overview is possible.</p>
            @elseif(!empty($feedback['error']))
                <p class="h5">Your text component has some errors that will need to be fixed.</p>
            @elseif(!empty($feedback['warning']))
                <p class="h5">Your text component is seemingly correct. There are some things the evaluator cannot determine, which have been listed.</p>
            @else
                <p class="h5">Your text component has some issues. Open the relevant tab on the left to view detailed issues.</p>
            @endif
        </div>

        {{-- Debug Tab --}}

        @if($options->getOption(\App\Domains\Minecraft\Tools\ToolOptions::DEBUG))

            @if(count($feedback['debug']) > 500)
                <div class="tab-pane" id="evaluationFeedbackTabDebug" role="tabpanel" aria-labelledby="evaluationFeedbackTabDebug-link">
                    <strong>Too many debug messages to display.</strong>
                </div>
            @else
                <div class="tab-pane" id="evaluationFeedbackTabDebug" role="tabpanel" aria-labelledby="evaluationFeedbackTabDebug-link">
                    @include('tools::chunks.evaluators.messages', ['feedbackId' => 0, 'messages' => $feedback['debug']])
                </div>
            @endif

        @endif

        {{-- Warnings Tab --}}

        <div class="tab-pane{{ (empty($feedback['fatal']) && empty($feedback['error']) && !empty($feedback['warning'])) ? ' active' : '' }}" id="evaluationFeedbackTabWarning" role="tabpanel" aria-labelledby="evaluationFeedbackTabWarning-link">
            @include('tools::chunks.evaluators.messages', ['feedbackId' => 1, 'messages' => $feedback['warning']])
        </div>

        {{-- Errors Tab --}}

        <div class="tab-pane{{ (empty($feedback['fatal']) && !empty($feedback['error'])) ? ' active' : '' }}" id="evaluationFeedbackTabError" role="tabpanel" aria-labelledby="evaluationFeedbackTabError-link">
            @include('tools::chunks.evaluators.messages', ['feedbackId' => 2, 'messages' => $feedback['error']])
        </div>

        {{-- Fatals Tab --}}

        <div class="tab-pane{{ (!empty($feedback['fatal'])) ? ' active' : '' }}" id="evaluationFeedbackTabFatal" role="tabpanel" aria-labelledby="evaluationFeedbackTabFatal-link">
            @include('tools::chunks.evaluators.messages', ['feedbackId' => 3, 'messages' => $feedback['fatal']])
        </div>
    </div>
</div>
