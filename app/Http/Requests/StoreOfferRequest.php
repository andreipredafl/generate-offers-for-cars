<?php

namespace App\Http\Requests;

use App\Models\Offer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOfferRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('offer_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'min:1',
                'max:256',
                'nullable',
            ],
            'image' => [
                'array',
            ],
            // 'link' => [
            //     'string',
            //     'min:10',
            //     'max:512',
            //     'required',
            //     'unique:offers',
            // ],
        ];
    }
}
