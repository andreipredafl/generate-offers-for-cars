<?php

namespace App\Http\Requests;

use App\Models\Field;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFieldRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('field_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:fields',
            ],
        ];
    }
}
