@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.field.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.fields.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.field.fields.id') }}
                        </th>
                        <td>
                            {{ $field->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.field.fields.name') }}
                        </th>
                        <td>
                            {{ $field->name }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.fields.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#field_offer_fields" role="tab" data-toggle="tab">
                {{ trans('cruds.offerField.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="field_offer_fields">
            @includeIf('admin.fields.relationships.fieldOfferFields', ['offerFields' => $field->fieldOfferFields])
        </div>
    </div>
</div>

@endsection