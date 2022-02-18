@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.offerField.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.offer-fields.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.offerField.fields.id') }}
                        </th>
                        <td>
                            {{ $offerField->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.offerField.fields.offer') }}
                        </th>
                        <td>
                            {{ $offerField->offer->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.offerField.fields.field') }}
                        </th>
                        <td>
                            {{ $offerField->field->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.offerField.fields.value') }}
                        </th>
                        <td>
                            {{ $offerField->value }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.offer-fields.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection