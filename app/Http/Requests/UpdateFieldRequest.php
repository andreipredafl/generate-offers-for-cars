<?php

namespace App\Http\Requests;

use App\Models\Field;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFieldRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('field_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:fields,name,' . request()->route('field')->id,
            ],
        ];
    }
}
