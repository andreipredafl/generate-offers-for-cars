<?php

namespace App\Http\Requests;

use App\Models\OfferField;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateOfferFieldRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('offer_field_edit');
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
