@extends('layouts.admin')
@section('content')
@can('light_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.lights.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.light.title_singular') }}
            </a>
            <a class="btn btn-info" href="{{ route("admin.lights.onAllLights") }}">
                {{ trans('global.on') }} {{ trans('cruds.light.title_singular') }}
            </a>
            <a class="btn btn-danger" href="{{ route("admin.lights.offAllLights") }}">
                {{ trans('global.off') }} {{ trans('cruds.light.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('cruds.light.title_singular') }} {{ trans('global.list') }}
        </h4>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-striped table-hover datatable datatable-User">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.light.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.light.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.light.fields.location') }}
                        </th>
                        <th>
                            {{ trans('cruds.light.fields.health') }}
                        </th>
                        <th>
                            {{ trans('cruds.light.fields.schedule') }}
                        </th>
                        <th style="text-align: center">
                            {{ trans('cruds.light.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lights as $key => $light)
                        <tr data-entry-id="{{ $light->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $light->id ?? '' }}
                            </td>
                            <td>
                                {{ $light->name ?? '' }}
                            </td>
                            <td>
                                {{ $light->location ?? '' }}
                            </td>
                            <td>
                                <span class="badge badge-{{$light->health == 2 ? 'success':($light->health == 1 ? 'warning':'danger') }}">{{ $light->health == 2 ? 'Good':($light->health == 1 ? 'Average':'Bad') }}</span>
                            </td>
                            <td>
                                {{ $light->schedule ?? '' }}
                            </td>
                            <td style="text-align: center">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" onchange="toggleLight({{$light->id}})" class="custom-control-input" id="customSwitch[]" {{ $light->status==1?'checked':'' }} disabled>
                                    <label class="custom-control-label" for="customSwitch[]">{{ $light->status==1?'ON - State':'OFF - State' }}</label>
                                </div>
                            </td>
                            <td>
                                @can('light_edit')
                                    <a class="btn btn-xs btn-{{ $light->status==1?'danger':'info' }}" href="{{ route('admin.lights.toggleONOFF', $light->id) }}">
                                        {{ $light->status==1?'OFF':'ON' }}
                                    </a>
                                @endcan
                                @can('light_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.lights.show', $light->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('light_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.lights.edit', $light->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('light_delete')
                                    <form action="{{ route('admin.lights.destroy', $light->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    function toggleLight(id) {
        console.log(id)
            $.ajax({
                headers: {'x-csrf-token': _token},
                method: 'POST',
                url: "{{ route('admin.lights.toggleONOFF') }}",
                data: { id: id, _method: 'POST' }})
                .done(function () {
                    // location.reload();
                })
    }
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('light_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.lights.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-User:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})



</script>
@endsection
