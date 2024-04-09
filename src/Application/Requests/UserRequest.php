<?php

namespace Application\Requests;


use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Contracts\Validation\Validator;


class UserRequest extends FormRequest

{
    public function rules($id = null)

    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users,email' . ($id == null ? '' : ',' . $id),
            'is_active' => 'required|boolean|max:1',
            'password' => 'required|string|max:255',
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
