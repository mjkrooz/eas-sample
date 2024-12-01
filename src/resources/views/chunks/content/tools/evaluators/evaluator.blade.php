@push('css-per')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.8/styles/atom-one-dark.min.css">

    <style>
        .sb-edition-selector a:first-child {
            border-top-left-radius: 25px !important;
            border-bottom-left-radius: 25px !important;
        }

        .sb-edition-selector a:last-child {
            border-top-right-radius: 25px !important;
            border-bottom-right-radius: 25px !important;
        }
    </style>
@endpush
{{--TODO: this <div class="text-left mb-3">
    <div class="btn-group sb-edition-selector myd-3" role="group">
        <a href="#!" class="btn btn-secondary disabled"><i class="fas fa-check"></i> Minecraft: Java Edition</a>
        <a href="#!" class="btn btn-outline-secondary">Minecraft: Bedrock Edition</a>
    </div>
</div> --}}
<div class="row">
    <div class="{{ $raw === null ? 'col-12' : 'col-md-7' }}">

        <form method="POST">
            @csrf
            <label for="component1" class="h4 d-block">{{ $label }}</label>
            <p>{{ $description }}</p>
            <div class="card bg-light text-dark">
                <div class="card-body">
                    <textarea name="advancements[]" id="advancements" class="form-control text-monospace" cols="30" rows="10">{{ $raw[0] ?? '' }}</textarea>
                    <div class="text-center">
                        <input type="submit" value="Evaluate" class="btn btn-success btn-block mt-3">
                    </div>
                </div>
            </div>
        </form>

        @if ($raw === 'wewewewe')
            <div class="row mt-3">
                <div class="col">
                    <div class="accordion my-4" id="reportList">
                        <form method="post">
                            @csrf
                            @foreach ($evaluations as $id => $evaluator)
                                @include('sourceblock::chunks.content.tools.evaluators.parts.report', ['reports' => $evaluator->getReports()])
                            @endforeach
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="{{ $raw === null ? 'd-none' : 'col-md-5' }}">

        @if (($statistics ?? null) !== null)
            <div class="card border-0 bg-transparent">
                <div id="stats">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-fill mb-3" id="statTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="statTab_simple" data-toggle="tab"
                                    href="#statTab_simple-tab" role="tab" aria-controls="statTab_simple-tab"
                                    aria-selected="true">Simple</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="statTab_values" data-toggle="tab" href="#statTab_values-tab"
                                    role="tab" aria-controls="statTab_values-tab">Values</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="statTabContent">
                            <div class="tab-pane active" id="statTab_simple-tab" role="tabpanel"
                                aria-labelledby="statTab_simple-tab">
                                <div class="row">
                                    @if (!empty($statistics['datatypes']))
                                        <div class="col-12">
                                            <canvas id="statsChart1"></canvas>
                                        </div>
                                    @endif
                                    @if ($statistics['reports']['info'] > 0 || $statistics['reports']['warnings'] > 0 || $statistics['reports']['fatals'] > 0)
                                        <div class="col-12">
                                            <canvas id="statsChart2"></canvas>
                                        </div>
                                    @endif
                                </div>


                                <div class="row mt-4">
                                    <div class="col-12 mb-3">
                                        <div class="card bg-light">
                                            <div class="card-body">
                                                <h4 class="card-title text-center border-bottom pb-2">Roots</h4>


                                                <table class="table table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <td>Datatypes:</td>
                                                            <td>
                                                                @if (empty($statistics['root']['datatypes']))
                                                            <td colspan="2">
                                                                <p class="lead">None</p>
                                                            </td>
                                                            @else
                                                            <ul class="list-group">
                                                                @foreach ($statistics['root']['datatypes'] as
                                                                $datatype => $amount)
                                                                <li class="list-group-item">
                                                                    <span class="badge badge-info mr-3">{{ $amount }}</span> {{ $datatype }}
                                                                </li>
                                                                @endforeach
                                                            </ul>
                                                            @endif
                                                            </td>
                                                        </tr>
                                                        @if ($statistics['root']['children'] > 0)
                                                        <tr>
                                                            <td>Elements/Fields:</td>
                                                            <td>{{ $statistics['root']['children'] }}</td>
                                                        </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($statistics['elements']['total'] > 0)
                                        <div class="col-12 mb-3">
                                            <div class="card bg-light">
                                                <div class="card-body">
                                                    <h4 class="card-title text-center border-bottom pb-2">Elements</h4>
                                                    <p class="lead">Valid values within arrays</p>
                                                    <table class="table table-borderless">
                                                        <tbody>
                                                            <tr>
                                                                <td>Total:</td>
                                                                <td>{{ $statistics['elements']['total'] }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($statistics['fields']['total'] > 0)
                                        <div class="col-12">
                                            <div class="card bg-light">
                                                <div class="card-body">
                                                    <h4 class="card-title text-center border-bottom pb-2">Fields</h4>
                                                    <p class="lead">Valid key/value pairs within objects</p>
                                                    <table class="table table-borderless">
                                                        <tbody>
                                                            <tr>
                                                                <td>Total:</td>
                                                                <td>{{ $statistics['fields']['total'] }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane" id="statTab_values-tab" role="tabpanel"
                                aria-labelledby="statTab_values-tab">

                                @if (empty($statistics['keys']))
                                    <p class="text-center lead">No values</p>
                                @endif

                                @foreach ($statistics['keys'] as $key => $data)

                                    @if ($key === 'null')
                                        <h4 class="h2 mt-5">Elements</h4>
                                    @else
                                        <h4 class="h2 mt-5"><code class="text-dark">{{ $key }}</code></h4>
                                    @endif
                                    <table class="table table-striped table-bordered">
                                        <thead class="thead-dark">
                                            <th width="15%">Type</th>
                                            <th width="15%">Total</th>
                                            <th>Values</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $type => $stats)
                                                <tr>
                                                    <td>{{ $type }}</td>
                                                    <td>{{ $stats['total'] }}</td>
                                                    <td>
                                                        @if ($type !== 'scalar')
                                                            <em>N/A</em>
                                                        @else
                                                            @if (count($stats['values']) > 5)
                                                                <a role="button" class="btn btn-secondary border btn-block btn-sm rounded-0" data-toggle="collapse" href="#collapseFor_{{ md5($key) }}" aria-expanded="false" aria-controls="collapseFor_{{ md5($key) }}">Show/hide all values</a>
                                                                <div class="collapse sb-semi-collapse border-bottom" id="collapseFor_{{ md5($key) }}" aria-expanded="false">
                                                                    <ul class="list-group">
                                                                        @foreach ($stats['values'] as $value => $amount)
                                                                            <li class="list-group-item rounded-0">
                                                                                <span class="badge badge-info mr-3">{{ $amount }}</span>
                                                                                @if (strlen($value) === 0)
                                                                                    <em>No value</em>
                                                                                @else
                                                                                    <code>{{ $value }}</code>
                                                                                @endif
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            @else
                                                                <ul class="list-group">
                                                                    @foreach ($stats['values'] as $value => $amount)
                                                                        <li class="list-group-item rounded-0">
                                                                            <span class="badge badge-info mr-3">{{ $amount }}</span>
                                                                            @if (strlen($value) === 0)
                                                                                <em>No value</em>
                                                                            @else
                                                                                <code>{{ $value }}</code>
                                                                            @endif
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

@push('js-after')
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.8/highlight.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.6.0"></script>
    <script>
        hljs.initHighlightingOnLoad();
    </script>
    <script>
        @if (!empty($statistics['datatypes']))
            let chart1 = document.getElementById('statsChart1').getContext('2d');
            let myChart1 = new Chart(chart1, {
                type: 'bar',
                data: {
                    labels: ['boolean', 'integer', 'double', 'string', 'array', 'object', 'null'],
                    datasets: [{
                        label: 'Datatypes',
                        @if ($statistics === null || empty($statistics['datatypes']))
                            data: [0, 0, 0, 0, 0, 0, 0],
                        @else
                            data: [{{ $statistics['datatypes']['boolean'] ?? 0 }}, {{ $statistics['datatypes']['integer'] ?? 0 }}, {{ $statistics['datatypes']['double'] ?? 0 }}, {{ $statistics['datatypes']['string'] ?? 0 }}, {{ $statistics['datatypes']['array'] ?? 0 }}, {{ $statistics['datatypes']['object'] ?? 0 }}, {{ $statistics['datatypes']['null'] ?? 0 }}],
                        @endif
                        backgroundColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(0, 0, 0, 1)'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: 'Datatypes'
                    },
                    legend: {
                        display: false,
                        position: 'right'
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                precision: 0
                            }
                        }]
                    }
                }
            });
        @endif

        @if (($statistics['reports']['info'] ?? 0) > 0 || ($statistics['reports']['warnings'] ?? 0) > 0 || ($statistics['reports']['fatals'] ?? 0) > 0)
            let chart2 = document.getElementById('statsChart2').getContext('2d');
            let myChart2 = new Chart(chart2, {
                type: 'bar',
                data: {
                    labels: ['info', 'warnings', 'fatals'],
                    datasets: [{
                        label: 'Reports',
                        data: [148, 1, 0],
                        @if ($statistics === null)
                            data: [0, 0, 0],
                        @else
                            data: [{{ $statistics['reports']['info'] ?? 0 }}, {{ $statistics['reports']['warnings'] ?? 0 }}, {{ $statistics['reports']['fatals'] ?? 0 }}],
                        @endif
                        backgroundColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(255, 99, 132, 1)'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: 'Reports'
                    },
                    legend: {
                        display: false,
                        position: 'right'
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                precision: 0
                            }
                        }]
                    }
                }
            });
        @endif
    </script>
@endpush
