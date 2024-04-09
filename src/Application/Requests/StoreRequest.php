<?php

namespace Application\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;


class StoreRequest extends FormRequest

{
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'address' =>'required|string',
            'active' => 'required|boolean'
        ];
    }


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'data' => $validator->errors()
        ]));

    }
}
