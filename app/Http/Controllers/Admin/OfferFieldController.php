<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOfferFieldRequest;
use App\Http\Requests\StoreOfferFieldRequest;
use App\Http\Requests\UpdateOfferFieldRequest;
use App\Models\Field;
use App\Models\Offer;
use App\Models\OfferField;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OfferFieldController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('offer_field_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $offerFields = OfferField::with(['offer', 'field'])->get();

        return view('admin.offerFields.index', compact('offerFields'));
    }

    public function create()
    {
        abort_if(Gate::denies('offer_field_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $offers = Offer::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $fields = Field::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.offerFields.create', compact('fields', 'offers'));
    }

    public function store(StoreOfferFieldRequest $request)
    {
        $offerField = OfferField::create($request->all());

        return redirect()->route('admin.offer-fields.index');
    }

    public function edit(OfferField $offerField)
    {
        abort_if(Gate::denies('offer_field_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $offers = Offer::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $fields = Field::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $offerField->load('offer', 'field');

        return view('admin.offerFields.edit', compact('fields', 'offerField', 'offers'));
    }

    public function update(UpdateOfferFieldRequest $request, OfferField $offerField)
    {
        $offerField->update($request->all());

        return redirect()->route('admin.offer-fields.index');
    }

    public function show(OfferField $offerField)
    {
        abort_if(Gate::denies('offer_field_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $offerField->load('offer', 'field');

        return view('admin.offerFields.show', compact('offerField'));
    }

    public function destroy(OfferField $offerField)
    {
        abort_if(Gate::denies('offer_field_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $offerField->delete();

        return back();
    }

    public function massDestroy(MassDestroyOfferFieldRequest $request)
    {
        OfferField::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
