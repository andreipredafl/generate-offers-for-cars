<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFieldRequest;
use App\Http\Requests\StoreFieldRequest;
use App\Http\Requests\UpdateFieldRequest;
use App\Models\Field;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FieldController extends Controller
{
    
    public function index()
    {
        abort_if(Gate::denies('field_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fields = Field::all();

        return view('admin.fields.index', compact('fields'));
    }

    public function create()
    {
        abort_if(Gate::denies('field_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fields.create');
    }

    public function store(StoreFieldRequest $request)
    {
        $field = Field::create($request->all());

        return redirect()->route('admin.fields.index');
    }

    public function edit(Field $field)
    {
        abort_if(Gate::denies('field_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fields.edit', compact('field'));
    }

    public function update(UpdateFieldRequest $request, Field $field)
    {
        $field->update($request->all());

        return redirect()->route('admin.fields.index');
    }

    public function show(Field $field)
    {
        abort_if(Gate::denies('field_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $field->load('fieldOfferFields');

        return view('admin.fields.show', compact('field'));
    }

    public function destroy(Field $field)
    {
        abort_if(Gate::denies('field_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $field->fieldOfferFields()->forceDelete();
        $field->forceDelete();

        return back();
    }

    public function massDestroy(MassDestroyFieldRequest $request)
    {
        $fields = Field::whereIn('id', request('ids'))->get();
        
        foreach($fields as $field) {
            $field->fieldOfferFields()->forceDelete();
            $field->forceDelete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
