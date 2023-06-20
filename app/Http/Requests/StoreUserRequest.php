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
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:10',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|max:16|min:8',
            'confirmPassword' => 'required|same:password|max:16',
            'citizen_identification' => 'required|unique:users',
        ];
    }
    /**
 * Get custom attributes for validator errors.
 *
 * @return array<string, string>
 */
    public function attributes(): array
    {
        return [
            'first_name' => 'họ và tên đệm',
            'last_name' => 'tên',
            'email' => 'địa chỉ email',
            'password' => 'mật khẩu',
            'confirmPassword' => 'xác nhận mật khẩu'
        ];
    }
    /**
 * Get the error messages for the defined validation rules.
 *
 * @return array<string, string>
 */
    // public function messages(): array
    // {
    //     return [
    //         'required' => 'Trường :attribute bắt buộc phải nhập',
    //         'max' => 'Trường :attribute không được lớn hơn :max ký tự',
    //         'min' => 'Trường :attribute không được lớn hơn :min ký tự',
    //         'unique' => 'Trường :attribute đã có người sử dụng'
    //     ];
    // }
    
}
