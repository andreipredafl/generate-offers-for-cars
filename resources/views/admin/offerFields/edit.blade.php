@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.offerField.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.offer-fields.update", [$offerField->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="offer_id">{{ trans('cruds.offerField.fields.offer') }}</label>
                <select class="form-control select2 {{ $errors->has('offer') ? 'is-invalid' : '' }}" name="offer_id" id="offer_id" required>
                    @foreach($offers as $id => $entry)
                        <option value="{{ $id }}" {{ (old('offer_id') ? old('offer_id') : $offerField->offer->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('offer'))
                    <span class="text-danger">{{ $errors->first('offer') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.offerField.fields.offer_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="field_id">{{ trans('cruds.offerField.fields.field') }}</label>
                <select class="form-control select2 {{ $errors->has('field') ? 'is-invalid' : '' }}" name="field_id" id="field_id" required>
                    @foreach($fields as $id => $entry)
                        <option value="{{ $id }}" {{ (old('field_id') ? old('field_id') : $offerField->field->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('field'))
                    <span class="text-danger">{{ $errors->first('field') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.offerField.fields.field_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="value">{{ trans('cruds.offerField.fields.value') }}</label>
                <textarea class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" name="value" id="value">{{ old('value', $offerField->value) }}</textarea>
                @if($errors->has('value'))
                    <span class="text-danger">{{ $errors->first('value') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.offerField.fields.value_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection