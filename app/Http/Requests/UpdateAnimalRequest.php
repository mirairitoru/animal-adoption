<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAnimalRequest extends FormRequest
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
            'animal_name' => 'required|string|max:101',
            'species' => 'required|in:犬,猫,その他',
            'age' => 'required|in:growth,youth,adult,senior',
            'sex' => 'required|in:オス,メス,その他',
            'personality' => 'required|array',
            'personality.*' => 'in:穏やか,人懐っこい,おっとり,好奇心旺盛,臆病,甘えん坊,マイペース,食いしん坊',
            'health_status' => 'nullable|string',
            'comment' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'animal_name.required' => '名前は必須です',
            'animal_name.max' => '名前は100文字以内で入力してください',
            'species.required' => '種類はどれか1つ選択してください',
            'age.required' => '年齢はどれか1つ選択してください',
            'sex.required' => '性別はどれか1つ選択してください',
            'personality.required' => '性格はどれか最低1つは選択してください',
        ];
    }
}
