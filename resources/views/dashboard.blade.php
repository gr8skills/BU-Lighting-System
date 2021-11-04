@extends('layouts.admin')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon">
                                <i class="fa fas-book"></i>
                                <i class="material-icons small">content_copy</i>
                            </div>
                            <p class="card-category">Number of Light(s)</p>
                            <h3 class="card-title">{{count($lights)}}
                            </h3>
                        </div>

                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-success card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">store</i>
                            </div>
                            <p class="card-category">Light(s) Turned ON</p>
                            <h3 class="card-title">{{count($lightsTurnedON)}}</h3>
                        </div>

                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-danger card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">cancel</i>
                            </div>
                            <p class="card-category">Light(s) Need Repair</p>
                            <h3 class="card-title">{{count($lightsNeedRepair)}}</h3>
                        </div>

                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">light</i>
                            </div>
                            <p class="card-category">Light(s) in Perfect Working Condition</p>
                            <h3 class="card-title">{{count($lightsPerfectCondition)}}</h3>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-chart">
                        <div class="card-header card-header-success">
                            <div class="ct-chart" id="dailySalesChart"></div>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Most Recent Light</h4>
                            <p class="card-category">
                                <span class="text-success"><i class="fa fa-long-arrow-up"></i> {{$mostRecentLight?$mostRecentLight->name:''}} </span> {{$mostRecentLight?$mostRecentLight->location:''}}.</p>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">access_time</i> added {{$mostRecentLight?$mostRecentLight->created_at:''}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-chart">
                        <div class="card-header card-header-warning">
                            <div class="ct-chart" id="websiteViewsChart"></div>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Bad Light (Most Recent)</h4>
                            <p class="card-category">
                                <span class="text-danger"><i class="fa fa-long-arrow-down"></i> {{$mostRecentBadLight?$mostRecentBadLight->name:'NONE'}} </span> {{$mostRecentBadLight?$mostRecentBadLight->location:'NIL'}}.</p>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">access_time</i> updated a moment ago
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-chart">
                        <div class="card-header card-header-info">
                            <div class="ct-chart" id="completedTasksChart"></div>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Last Altered Light</h4>
                            <p class="card-category">
                                <span class="text-info"><i class="fa fa-long-arrow-down"></i> {{$lights?$lights[0]->name:'NONE'}} </span> {{$lights?$lights[0]->location:'NIL'}}.</p>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">access_time</i> updated {{$lights?$lights[0]->updated_at:'Nil'}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Lights Needing Urgent Attention</h4>
                            <p class="card-category">Lights that are either bad or in average working condition as at {{date('Y-m-d H:i:s')}}</p>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover">
                                <thead class="text-success">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Health</th>
                                <th>Location</th>
                                <th></th>
                                </thead>
                                <tbody>
                                @if(isset($lightsNeedsAttention) && count($lightsNeedsAttention)>0)
                                    @php($index = 0)
                                    @foreach($lightsNeedsAttention as $light)
                                        <tr>
                                            <td>{{$index+1}}</td>
                                            <td>{{$light->name}}</td>
                                            <td>
                                                <span class="badge badge-{{$light->health == 2 ? 'success':($light->health == 1 ? 'warning':'danger') }}">{{ $light->health == 2 ? 'Good':($light->health == 1 ? 'Average':'Bad') }}</span>
                                            </td>
                                            <td>{{$light->location}}</td>
                                            <td>
                                                @can('light_show')
                                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.lights.show', $light->id) }}">
                                                        {{ trans('global.view') }}
                                                    </a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header card-header-success">
                            <h4 class="card-title">Latest Lights</h4>
                            <p class="card-category">Latest Lights as at {{date('Y-m-d H:i:s')}}</p>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover">
                                <thead class="text-success">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Health</th>
                                <th style="text-align: center">Status</th>
                                <th></th>
                                </thead>
                                <tbody>
                                @if(isset($lights))
                                    @php($index = 0)
                                    @foreach($lights as $light)
                                        <tr>
                                            <td>{{$index+1}}</td>
                                            <td>{{$light->name}}</td>
                                            <td>
                                                <span class="badge badge-{{$light->health == 2 ? 'success':($light->health == 1 ? 'warning':'danger') }}">{{ $light->health == 2 ? 'Good':($light->health == 1 ? 'Average':'Bad') }}</span>
                                            </td>
                                            <td style="text-align: center">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="customSwitch1" {{ $light->status==1?'checked':'' }} disabled>
                                                    <label class="custom-control-label" for="customSwitch1">{{ $light->status==1?'ON - State':'OFF - State' }}</label>
                                                </div>
                                            </td>
                                            <td>
                                                @can('light_show')
                                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.lights.show', $light->id) }}">
                                                        {{ trans('global.view') }}
                                                    </a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>
        $(document).ready(function() {
            // Javascript method's body can be found in assets/js/demos.js
            md.initDashboardPageCharts();
        });
    </script>
@endpush
