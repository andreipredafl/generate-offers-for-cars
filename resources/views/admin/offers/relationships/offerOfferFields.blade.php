<div class="m-3">
    @can('offer_field_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.offer-fields.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.offerField.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.offerField.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-offerOfferFields">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.offerField.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.offerField.fields.offer') }}
                            </th>
                            <th>
                                {{ trans('cruds.offerField.fields.field') }}
                            </th>
                            <th>
                                {{ trans('cruds.offerField.fields.value') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($offerFields as $key => $offerField)
                            <tr data-entry-id="{{ $offerField->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $offerField->id ?? '' }}
                                </td>
                                <td>
                                    {{ $offerField->offer->title ?? '' }}
                                </td>
                                <td>
                                    {{ $offerField->field->name ?? '' }}
                                </td>
                                <td>
                                    {{ $offerField->value ?? '' }}
                                </td>
                                <td>
                                    @can('offer_field_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.offer-fields.show', $offerField->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('offer_field_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.offer-fields.edit', $offerField->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('offer_field_delete')
                                        <form action="{{ route('admin.offer-fields.destroy', $offerField->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('offer_field_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.offer-fields.massDestroy') }}",
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
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-offerOfferFields:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection