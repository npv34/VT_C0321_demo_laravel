<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:2',
            'email' => 'required|email|unique:App\Models\User,email',
            'phone' => ['nullable','numeric','regex:/^(84|0[3|5|7|8|9])+([0-9]{8})$/'],
            'birthday' => 'nullable|date',
            'password' => 'required|min:6|max:16'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Truong ten khong duoc de trong',
            'name.min' => 'Truong ten it nhat 2 ky  tu',
        ];
    }
}
