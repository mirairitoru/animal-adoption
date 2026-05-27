<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'nickname' => 'required|string|max:256',
            'residence_area' => 'nullable|string',
            'user_age' => 'nullable|integer|min:1|max:119',
            'animal_care_experience' => 'nullable|string',
            'animal_care_details' => 'nullable|string',
            'self_introduction' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return[
            'nickname.required' => 'ニックネームは必須です。',
            'nickname.max' => 'ニックネームは255文字以内で入力してください',

            'user_age.integer' => '年齢は数字のみで入力してください',
            'user_age.min' => '年齢は1以上で入力してください',
            'user_age.max' => '年齢は120以下で入力してください',
        ];
    }
}
