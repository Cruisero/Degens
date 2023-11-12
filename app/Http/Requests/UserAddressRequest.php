<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAddressRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'province'      => 'required',
            'city'          => 'required',
            'district'      => 'required',
            'address'       => 'required',
            'zip'           => 'required',
            'contact_name'  => 'required',
            'contact_phone' => 'required',
        ];



    }

    public function attributes()
    {
        return [
            'zip'           => '邮编',
            'contact_name'  => '姓名',
            'contact_phone' => '电话',
        ];
    }
}
