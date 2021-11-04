@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.create') }} {{ trans('cruds.light.title_singular') }}
        </h4>
    </div>

    <div class="card-body">
        <form action="{{ route("admin.lights.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.light.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($light) ? $light->name : '') }}" required>
                @if($errors->has('name'))
                    <p class="help-block">
                        {{ $errors->first('name') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.light.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
                <label for="location">{{ trans('cruds.light.fields.location') }}*</label>
                <input type="text" id="location" name="location" class="form-control" value="{{ old('location', isset($light) ? $light->location : '') }}" placeholder="Full Address" required>
                @if($errors->has('location'))
                    <p class="help-block">
                        {{ $errors->first('location') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.light.fields.location_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('gmap_location') ? 'has-error' : '' }}">
                <label for="gmap_location">{{ trans('cruds.light.fields.gmap_location') }}*</label>
                <input type="text" id="gmap_location" name="gmap_location" class="form-control" value="{{ old('gmap_location', isset($light) ? $light->gmap_location : '') }}" placeholder="Enter Google Map Location">
                @if($errors->has('gmap_location'))
                    <p class="help-block">
                        {{ $errors->first('gmap_location') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.light.fields.gmap_location_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('gps_location') ? 'has-error' : '' }}">
                <label for="gps_location">{{ trans('cruds.light.fields.gps_location') }}*</label>
                <input type="text" id="gps_location" name="gps_location" class="form-control" value="{{ old('gps_location', isset($light) ? $light->gps_location : '') }}" placeholder="Enter GPS Coordinate (Longitude, Latitude)">
                @if($errors->has('gps_location'))
                    <p class="help-block">
                        {{ $errors->first('gps_location') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.light.fields.gps_location_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('health') ? 'has-error' : '' }} col-lg-3 col-md-6 col-sm-12 p-2">
                <label for="health">{{ trans('cruds.light.fields.health') }}*</label>
                <select name="health" id="health" class="form-control select2">
                    <option value="2"> Good </option>
                    <option value="1"> Average </option>
                    <option value="0"> Bad </option>
                </select>
                @if($errors->has('health'))
                    <p class="help-block">
                        {{ $errors->first('health') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.light.fields.health_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }} col-lg-3 col-md-6 col-sm-12 p-2">
                <label for="status">{{ trans('cruds.light.fields.status') }}*</label>
                <select name="status" id="status" class="form-control select2">
                    <option value="1"> ON </option>
                    <option value="0"> OFF </option>
                </select>
                @if($errors->has('status'))
                    <p class="help-block">
                        {{ $errors->first('status') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.light.fields.status_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('schedule') ? 'has-error' : '' }}">
                <label for="schedule">{{ trans('cruds.light.fields.schedule') }}</label>
                <input type="text" id="schedule" name="schedule" class="form-control" placeholder="18-01-00 (24 hour format)" required>
                @if($errors->has('schedule'))
                    <p class="help-block">
                        {{ $errors->first('schedule') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.light.fields.schedule_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('power_consumption') ? 'has-error' : '' }}">
                <label for="power_consumption">{{ trans('cruds.light.fields.power_consumption') }}</label>
                <input type="text" id="power_consumption" name="power_consumption" class="form-control" placeholder="60-Watt" required>
                @if($errors->has('power_consumption'))
                    <p class="help-block">
                        {{ $errors->first('power_consumption') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.light.fields.power_consumption_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection
