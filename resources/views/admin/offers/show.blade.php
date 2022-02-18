@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.offer.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group row justify-content-between">
                <div class="col-auto">
                    <a class="btn btn-default" href="{{ route('admin.offers.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                
                <div class="col-auto">
                    <a href="{{ route('admin.offers.edit', $offer->id) }}" class="btn btn-success">
                        <i class="fas fa-pen mr-1"></i>
                        Edit offer
                    </a>
                </div>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.offer.fields.id') }}
                        </th>
                        <td>
                            {{ $offer->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.offer.fields.title') }}
                        </th>
                        <td>
                            {{ $offer->title }}
                        </td>
                    </tr>
                    
                    @foreach ($offer->offerOfferFields as $offerField)
                        <tr>
                            <th>
                                {{ $offerField->field ? $offerField->field->name : '...' }}
                            </th>
                            <td>
                                {{ $offerField->value }}
                            </td>
                        </tr>
                    @endforeach
                    
                    <tr>
                        <th>
                            {{ trans('cruds.offer.fields.description') }}
                        </th>
                        <td>
                            {!! $offer->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.offer.fields.video') }}
                        </th>
                        <td>
                            @if($offer->video)
                                <a href="{{ $offer->video->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.offer.fields.image') }}
                        </th>
                        <td>
                            @foreach($offer->image as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.offer.fields.link') }}
                        </th>
                        <td>
                            <a href="{{ $offer->link }}" target="_blank">
                                {{ $offer->link }}
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.offer.fields.video_url') }}
                        </th>
                        <td>
                            <a href="{{ $offer->link }}" target="_blank">
                                {{ $offer->video_url }}
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group row justify-content-between">
                <div class="col-auto">
                    <a class="btn btn-default" href="{{ route('admin.offers.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                
                <div class="col-auto">
                    <a href="{{ route('admin.offers.edit', $offer->id) }}" class="btn btn-success">
                        <i class="fas fa-pen mr-1"></i>
                        Edit offer
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#offer_offer_fields" role="tab" data-toggle="tab">
                {{ trans('cruds.offerField.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="offer_offer_fields">
            @includeIf('admin.offers.relationships.offerOfferFields', ['offerFields' => $offer->offerOfferFields])
        </div>
    </div>
</div> --}}

@endsection