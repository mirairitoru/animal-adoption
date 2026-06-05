<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules():array
    {
        $role = $this->input('role');
        if ($role === 'organization') {
            return [
                'org_name' => 'required|string|max:255',
                'contact_name' => 'required|string|max:100',
                'email' => 'required|email|unique:organizations,email',
                'password' => 'required|confirmed|min:8',
            ];
        };
        return [
            'user_name' => 'required|string|max:255',
            'nickname' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ];
    }

    public function messages()
    {
        $role = $this->input('role');
        if ($role === 'organization') {
            return [
                'org_name.required' => '団体名は必須です',
                'contact_name.required' => '担当者名は必須です',
                'email.required' => 'メールアドレスは必須です',
                'email.email' => 'メールアドレス形式で入力してください',
                'email.unique' => 'このメールアドレスは既に登録されています',
                'password.required' => 'パスワードは必須です',
                'password.confirmed' => 'パスワードが一致しません',
                'password.min' => 'パスワードは8文字以上で入力してください',
            ];
        };
        return [
            'user_name.required' => '名前は必須です',
            'nickname.required' => 'ニックネームは必須です',
            'nickname.max' => 'ニックネームは100文字以内で入力してください',
            'email.required' => 'メールアドレスは必須です',
            'email.email' => 'メールアドレス形式で入力してださい',
            'email.unique' => 'このメールアドレスは既に登録されています',
            'password.required' => 'パスワードは必須です',
            'password.confirmed' => 'パスワードが一致しません',
            'password.min' => 'パスワードは8文字以上で入力してください',
        ];
    }
}
