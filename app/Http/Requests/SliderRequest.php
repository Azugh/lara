<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
            'title' => 'required|string|max:25',
            'content' => 'required|string|max:50',
            // 'content' => ['required','string', 'max:50'],
            'btn_text' => 'required|string|max:15',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'isActive' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Заголовок обязателен для заполнения',
            'title.string' => 'Заголовок должен быть строкой',
            'title.max' => 'Заголовок не должен превышать 25 символов',
            'content.required' => 'Содержание обязательно для заполнения',
            'content.string' => 'Содержание должно быть текстом',
            'content.max' => 'Содержание не должно превышать 50 символов',
            'btn_text.required' => 'Текст кнопки обязателен для заполнения',
            'btn_text.string' => 'Текст кнопки должен быть строкой',
            'btn_text.max' => 'Текст кнопки не должен превышать 15 символов',
            'image.required' => 'Изображение обязательно',
            'image.image' => 'Файл должен быть изображением',
            'image.mimes' => 'Допустимые форматы: PNG, JPG, JPEG',
            'image.max' => 'Максимальный размер файла: 2MB',
            'image.dimensions' => 'Размер изображения должен быть от 100x100 до 1000x1000 пикселей',
            'isActive.boolean'=> 'True или False',
        ];
    }
}
