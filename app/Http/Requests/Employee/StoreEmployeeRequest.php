<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'firstName' => 'required|string|max:50',
            'lastName' => 'required|string|max:10',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:16',
            'confirmPassword' => 'required|min:8|max:16|same:password',
            'phoneNumber' => 'required|numeric',
            'basicSalary' => 'required|numeric',
            'startDate' => 'required'
        ];
    }
    public function attributes(): array
    {
        return [
            'firstName' => 'Họ và tên đệm',
            'lastName' => 'Tên',
            'email' => 'Địa chỉ email',
            'password' => 'Mật khẩu',
            'confirmPassword' => 'Mật khẩu',
            'phoneNumber' => 'Số điện thoại',
            'citizenIdentification' => 'CCCD/CMND',
            'basicSalary' => 'Lương cơ bản',
            'address' => 'Địa chỉ',
            'startDate' => 'Ngày vào làm'
        ];
    }
    /**
 * Get the error messages for the defined validation rules.
 *
 * @return array<string, string>
 */
    public function messages(): array
    {
        return [
            'required' => ':attribute bắt buộc phải nhập',
            'max' => ':attribute không được lớn hơn :max ký tự',
            'min' => ':attribute phải lớn hơn :min ký tự',
            'unique' => ':attribute đã có người sử dụng',
            'numeric' => ':attribute chỉ được là số',
            'string' => ':attribute chỉ được là chữ',
            'confirmed' => ':attribute bắt buộc phải trùng nhau',
            'same' => ':attribute bắt buộc phải trùng nhau'
        ];
    }
}
