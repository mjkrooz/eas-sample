
{{-- Evaluation Header --}}

@if (!empty($reports['fatal']))
    <a href="#evaluationReport_{{ $id }}" class="bg-danger text-light d-block p-3 h5 mb-0" data-parent="#reportList" data-toggle="collapse"><i class="fas fa-times-circle text-light"></i> Evaluation #{{ $id + 1 }}</a>
@elseif (!empty($reports['warning']) || !empty($reports['error']))
    <a href="#evaluationReport_{{ $id }}" class="bg-warning text-dark d-block p-3 h5 mb-0" data-parent="#reportList" data-toggle="collapse"><i class="fas fa-exclamation-circle text-dark"></i> Evaluation #{{ $id + 1 }}</a>
@else
    <a href="#evaluationReport_{{ $id }}" class="bg-light text-dark d-block p-3 h5 mb-0" data-parent="#reportList" data-toggle="collapse"><i class="fas fa-check-square text-success"></i> Evaluation #{{ $id + 1 }}</a>
@endif

{{-- Evaluation Body --}}

<div class="card rounded-0">
    <div id="evaluationReport_{{ $id }}" class="collapse{{ !empty($reports['error']) ? ' show' : '' }}">
        <div class="card-body">

            {{-- Evaluation Tabs Menu --}}

            <ul class="nav nav-tabs nav-fill mb-3" id="evaluationReportTabList_{{ $id }}" role="tablist">
                <li class="nav-item">
                    <a class="nav-link{{ (empty($reports['warnings']) && empty($reports['error']) && empty($reports['fatal'])) ? ' active' : '' }}" id="evaluationReportTabRaw_{{ $id }}-link" data-toggle="tab" href="#evaluationReportTabRaw_{{ $id }}" role="tab" aria-controls="evaluationReportTabRaw_{{ $id }}" aria-selected="false">Raw</a>
                </li>
{{-- TODO: if debug is true, show this.               --}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link{{ empty($reports['error']) ? ' active' : '' }}" id="evaluationReportTabInfo_{{ $id }}-link" data-toggle="tab" href="#evaluationReportTabInfo_{{ $id }}" role="tab" aria-controls="evaluationReportTabInfo_{{ $id }}" aria-selected="{{ empty($reports['error']) }}">Info ({{ count($reports['debug']) }})</a>--}}
{{--                </li>--}}
                <li class="nav-item">
                    <a class="nav-link{{ (!empty($reports['warning']) || !empty($reports['error'])) && empty($reports['fatal']) ? ' active' : '' }}" id="evaluationReportTabWarnings_{{ $id }}-link" data-toggle="tab" href="#evaluationReportTabWarnings_{{ $id }}" role="tab" aria-controls="evaluationReportTabWarnings_{{ $id }}" aria-selected="{{ (!empty($reports['warning']) || !empty($reports['error'])) && !empty($reports['fatal']) }}">Warnings ({{ (count($reports['warning']) + count($reports['error'])) }})</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ !empty($reports['fatal']) ? ' active' : '' }}" id="evaluationReportTabFatals_{{ $id }}-link" data-toggle="tab" href="#evaluationReportTabFatals_{{ $id }}" role="tab" aria-controls="evaluationReportTabFatals_{{ $id }}" aria-selected="{{ !empty($reports['fatal']) }}">Fatals ({{ count($reports['fatal']) }})</a>
                </li>
            </ul>

{{--             Tabs Content--}}


            <div class="tab-content">
                <div class="tab-pane{{ (empty($reports['warnings']) && empty($reports['error']) && empty($reports['fatal'])) ? ' active' : '' }}" id="evaluationReportTabRaw_{{ $id }}" role="tabpanel" aria-labelledby="evaluationReportTabRaw_{{ $id }}-link">
                    <textarea id="evaluatedContent_{{ $id }}" name="evaluatedContent[]" rows="8" class="form-control bg-dark text-light text-monospace">{{ $raw[$id] ?? '' }}</textarea>
                    <input type="submit" value="Re-Evaluate" class="btn btn-light border-shadow-sm btn-block btn-lg mt-2">
                </div>
{{--  TODO: if debug true               --}}
{{--                <div class="tab-pane{{ empty($reports['error']) ? ' active' : '' }}" id="evaluationReportTabInfo_{{ $id }}" role="tabpanel" aria-labelledby="evaluationReportTabInfo_{{ $id }}-link">--}}
{{--                    @include('sourceblock::chunks.content.tools.evaluators.parts.report-list', ['list' => $reports['warning'], 'reportType' => 'info'])--}}

{{--                    @if (empty($reports['debug']))--}}
{{--                        <p class="lead font-italic">No additional info</p>--}}
{{--                    @endif--}}
{{--                </div>--}}
                <div class="tab-pane{{ (!empty($reports['warning']) || !empty($reports['error'])) && empty($reports['fatal']) ? ' active' : '' }}" id="evaluationReportTabWarnings_{{ $id }}" role="tabpanel" aria-labelledby="evaluationReportTabWarnings_{{ $id }}-link">
                    @include('tools::chunks.evaluators.report-listold', ['list' => array_merge($reports['warning'], $reports['error']), 'reportType' => 'warning'])

                    @if (empty($reports['warning']) && empty($reports['error']))
                        <p class="lead font-italic">No warnings</p>
                    @endif
                </div>
                <div class="tab-pane{{ !empty($reports['fatal']) ? ' active' : '' }}" id="evaluationReportTabFatals_{{ $id }}" role="tabpanel" aria-labelledby="evaluationReportTabFatals_{{ $id }}-link">
                    @include('tools::chunks.evaluators.report-listold', ['list' => $reports['fatal'], 'reportType' => 'fatal'])

                    @if (empty($reports['fatal']))
                        <p class="lead font-italic">No fatal errors</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
