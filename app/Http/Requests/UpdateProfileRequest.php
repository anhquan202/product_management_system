<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:15|unique:users,phone_number',
            'email' => 'required|email|max:255|unique:users,email',
            'address' => 'nullable|string|max:255',
            'gender' => 'required|string'
        ];
    }
    public function messages(): array
    {
        return [
            'first_name.required' => 'Vui lòng nhập họ.',
            'first_name.string' => 'Họ phải là một chuỗi ký tự.',
            'first_name.max' => 'Họ không được vượt quá 255 ký tự.',

            'last_name.required' => 'Vui lòng nhập tên.',
            'last_name.string' => 'Tên phải là một chuỗi ký tự.',
            'last_name.max' => 'Tên không được vượt quá 255 ký tự.',

            'phone_number.string' => 'Số điện thoại phải là một chuỗi ký tự.',
            'phone_number.max' => 'Số điện thoại không được vượt quá 15 ký tự.',
            'phone_number.unique' => 'Số điện thoại đã tồn tại.',

            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',
            'email.unique' => 'Email đã tồn tại.',

            'address.string' => 'Địa chỉ phải là một chuỗi ký tự.',
            'address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',

            'gender.required' => 'Vui lòng chọn giới tính.',
            'gender.string' => 'Giới tính phải là một chuỗi ký tự.',
        ];
    }
    public function failedValidation(Validator $validator)
    {
        $errors = collect($validator->errors())->map(function ($messages) {
            return $messages[0];
        });

        throw new HttpResponseException(
            response()->json([
                'message' => 'Validation failed.',
                'errors' => $errors,
            ], 422)
        );
    }
}
