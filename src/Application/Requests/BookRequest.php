<?php

namespace Application\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;


class BookRequest extends FormRequest

{
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'isbn' =>'integer',
            'value' => 'numeric|between:0,99.99'
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
