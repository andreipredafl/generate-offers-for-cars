<?php

namespace App\Http\Requests;

use App\Models\OfferField;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOfferFieldRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('offer_field_create');
    }

    public function rules()
    {
        return [
            'offer_id' => [
                'required',
                'integer',
            ],
            'field_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
