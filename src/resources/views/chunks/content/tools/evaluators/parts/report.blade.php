
@if ($reports->hasAnyFatals())
    <a href="#evaluationReport_{{ $id }}" class="bg-danger text-light d-block p-3 h5 mb-0" data-parent="#reportList" data-toggle="collapse"><i class="fas fa-times-circle text-light"></i> {{ $evaluator->getName() }}</a>
@elseif ($reports->hasAnyWarnings())
    <a href="#evaluationReport_{{ $id }}" class="bg-warning text-dark d-block p-3 h5 mb-0" data-parent="#reportList" data-toggle="collapse"><i class="fas fa-exclamation-circle text-dark"></i> {{ $evaluator->getName() }}</a>
@else
    <a href="#evaluationReport_{{ $id }}" class="bg-light text-dark d-block p-3 h5 mb-0" data-parent="#reportList" data-toggle="collapse"><i class="fas fa-check-square text-success"></i> {{ $evaluator->getName() }}</a>
@endif

<div class="card rounded-0">
    <div id="evaluationReport_{{ $id }}" class="collapse{{ $reports->hasAnyErrors() ? ' show' : '' }}">
        <div class="card-body">
            
            {{-- Tabs Menu --}}

            <ul class="nav nav-tabs nav-fill mb-3" id="evaluationReportTabList_{{ $id }}" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="evaluationReportTabRaw_{{ $id }}-link" data-toggle="tab" href="#evaluationReportTabRaw_{{ $id }}" role="tab" aria-controls="evaluationReportTab_{{ $id }}" aria-selected="false">Raw</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ !$reports->hasAnyErrors() ? ' active' : '' }}" id="evaluationReportTabInfo_{{ $id }}-link" data-toggle="tab" href="#evaluationReportTabInfo_{{ $id }}" role="tab" aria-controls="evaluationReportTabInfo_{{ $id }}" aria-selected="{{ !$reports->hasAnyErrors() }}">Info ({{ count($reports->getAllInfo()) }})</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ $reports->hasAnyWarnings() && !$reports->hasAnyFatals() ? ' active' : '' }}" id="evaluationReportTabWarnings_{{ $id }}-link" data-toggle="tab" href="#evaluationReportTabWarnings_{{ $id }}" role="tab" aria-controls="evaluationReportTabWarnings_{{ $id }}" aria-selected="{{ $reports->hasAnyWarnings() && !$reports->hasAnyFatals() }}">Warnings ({{ count($reports->getAllWarnings()) }})</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ $reports->hasAnyFatals() ? ' active' : '' }}" id="evaluationReportTabFatals_{{ $id }}-link" data-toggle="tab" href="#evaluationReportTabFatals_{{ $id }}" role="tab" aria-controls="evaluationReportTabFatals_{{ $id }}" aria-selected="{{ $reports->hasAnyFatals() }}">Fatals ({{ count($reports->getAllFatals()) }})</a>
                </li>
            </ul>

            {{-- Tabs Content --}}

            
            <div class="tab-content">
                <div class="tab-pane" id="evaluationReportTabRaw_{{ $id }}" role="tabpanel" aria-labelledby="evaluationReportTabRaw_{{ $id }}-link">
                    <textarea id="evaluatedContent_{{ $id }}" name="evaluatedContent[]" rows="8" class="form-control bg-dark text-light text-monospace">{{ $evaluator->getRawJson() }}</textarea>
                    <input type="submit" value="Re-Evaluate" class="btn btn-light border-shadow-sm btn-block btn-lg mt-2">
                </div>
                <div class="tab-pane{{ !$reports->hasAnyErrors() ? ' active' : '' }}" id="evaluationReportTabInfo_{{ $id }}" role="tabpanel" aria-labelledby="evaluationReportTabInfo_{{ $id }}-link">
                    @include('sourceblock::chunks.content.tools.evaluators.parts.report-list', ['list' => $reports->getAllInfo(), 'reportType' => 'info'])

                    @if (empty($reports->getAllInfo()))
                        <p class="lead font-italic">No additional info</p>
                    @endif
                </div>
                <div class="tab-pane{{ $reports->hasAnyWarnings() && !$reports->hasAnyFatals() ? ' active' : '' }}" id="evaluationReportTabWarnings_{{ $id }}" role="tabpanel" aria-labelledby="evaluationReportTabWarnings_{{ $id }}-link">
                    @include('sourceblock::chunks.content.tools.evaluators.parts.report-list', ['list' => $reports->getAllWarnings(), 'reportType' => 'warning'])

                    @if (empty($reports->getAllWarnings()))
                        <p class="lead font-italic">No warnings</p>
                    @endif
                </div>
                <div class="tab-pane{{ $reports->hasAnyFatals() ? ' active' : '' }}" id="evaluationReportTabFatals_{{ $id }}" role="tabpanel" aria-labelledby="evaluationReportTabFatals_{{ $id }}-link">
                    @include('sourceblock::chunks.content.tools.evaluators.parts.report-list', ['list' => $reports->getAllFatals(), 'reportType' => 'fatal'])
                    
                    @if (empty($reports->getAllFatals()))
                        <p class="lead font-italic">No fatal errors</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>