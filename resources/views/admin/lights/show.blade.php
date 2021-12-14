@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.show') }} {{ trans('cruds.light.title') }}
        </h4>
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.light.fields.id') }}
                        </th>
                        <td>
                            {{ $light->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.light.fields.name') }}
                        </th>
                        <td>
                            {{ $light->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.light.fields.location') }}
                        </th>
                        <td>
                            {{ $light->location }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.light.fields.gmap_location') }}
                        </th>
                        <td>
                            {{ $light->gmap_location }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.light.fields.gps_location') }}
                        </th>
                        <td>
                            {{ $light->gps_location }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.light.fields.health') }}
                        </th>
                        <td>
                            <span class="badge badge-{{$light->health == 2 ? 'success':($light->health == 1 ? 'warning':'danger') }}">{{ $light->health == 2 ? 'Good':($light->health == 1 ? 'Average':'Bad') }}</span>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.light.fields.status') }}
                        </th>
                        <td>
                            <div class="custom-control custom-switch" style="margin-left: 15px">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1" {{ $light->status==1?'checked':'' }} disabled>
                                <label class="custom-control-label" for="customSwitch1">{{ $light->status==1?'ON - State':'OFF - State' }}</label>
                            </div>
                            @can('light_edit')
                                <a class="btn btn-xs btn-{{ $light->status==1?'danger':'info' }}" href="{{ route('admin.lights.toggleONOFF', $light->id) }}">
                                    {{ $light->status==1?'OFF':'ON' }}
                                </a>
                            @endcan
                        </td>

                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.light.fields.schedule') }}
                        </th>
                        <td>
                            {{ $light->schedule }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.light.fields.power_consumption') }}
                        </th>
                        <td>
                            {{ $light->power_consumption }}{{'kWh'}}
                        </td>
                    </tr>

                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>


    </div>
</div>
@endsection
