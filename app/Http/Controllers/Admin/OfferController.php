<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyOfferRequest;
use App\Http\Requests\StoreOfferRequest;
use App\Http\Requests\UpdateOfferRequest;
use App\Models\Offer;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Field;
use App\Models\OfferField;
use Str;

class OfferController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('offer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $offers = Offer::with(['media'])->get();

        return view('admin.offers.index', compact('offers'));
    }

    public function create()
    {
        abort_if(Gate::denies('offer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fields = Field::all();
        
        return view('admin.offers.create', compact('fields'));
    }

    public function store(StoreOfferRequest $request)
    {
        $request['link'] = env('APP_URL').'/offer/'.Str::random(10).'-'.round(microtime(true) * 1000);
        
        $offer = Offer::create($request->all());
        
        foreach($request->fields_values as $key => $field_value) {
            if($field_value != null && isset($request->fields_ids[$key]) && $request->fields_ids[$key]) {
                OfferField::create([
                    'offer_id' => $offer->id,
                    'field_id' => $request->fields_ids[$key],
                    'value' => $field_value,
                ]);
            }
        }

        if ($request->input('video', false)) {
            $offer->addMedia(storage_path('tmp/uploads/' . basename($request->input('video'))))->toMediaCollection('video');
        }

        foreach ($request->input('image', []) as $file) {
            $offer->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $offer->id]);
        }

        return redirect()->route('admin.offers.index');
    }

    public function edit(Offer $offer)
    {
        abort_if(Gate::denies('offer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fields = Field::all();
        return view('admin.offers.edit', compact('offer', 'fields'));
    }

    public function update(UpdateOfferRequest $request, Offer $offer)
    {
        
        $offer->update($request->all());
        
        $offer->offerOfferFields()->forceDelete();

        foreach($request->fields_values as $key => $field_value) {
            if($field_value != null && isset($request->fields_ids[$key]) && $request->fields_ids[$key]) {
                OfferField::create([
                    'offer_id' => $offer->id,
                    'field_id' => $request->fields_ids[$key],
                    'value' => $field_value,
                ]);
            }
        }

        if ($request->input('video', false)) {
            if (!$offer->video || $request->input('video') !== $offer->video->file_name) {
                if ($offer->video) {
                    $offer->video->delete();
                }
                $offer->addMedia(storage_path('tmp/uploads/' . basename($request->input('video'))))->toMediaCollection('video');
            }
        } elseif ($offer->video) {
            $offer->video->delete();
        }

        if (count($offer->image) > 0) {
            foreach ($offer->image as $media) {
                if (!in_array($media->file_name, $request->input('image', []))) {
                    $media->delete();
                }
            }
        }
        $media = $offer->image->pluck('file_name')->toArray();
        foreach ($request->input('image', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $offer->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('image');
            }
        }

        return redirect()->route('admin.offers.index');
    }

    public function show(Offer $offer)
    {
        abort_if(Gate::denies('offer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $offer->load('offerOfferFields');

        return view('admin.offers.show', compact('offer'));
    }

    public function destroy(Offer $offer)
    {
        abort_if(Gate::denies('offer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $offer->offerOfferFields()->forceDelete();
        $offer->forceDelete();

        return back();
    }

    public function massDestroy(MassDestroyOfferRequest $request)
    {
        Offer::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('offer_create') && Gate::denies('offer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Offer();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
