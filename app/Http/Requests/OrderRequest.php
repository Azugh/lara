<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'id' => 'required|exists:carts',
            'userAddress' => 'required|string|max:255',
        ];
    }


    public function messages(): array
    {
        return [
            'userAddress.required' => 'Адрес обязателен для заполнения',
            'userAddress.max' => 'Поле не может содержать больше 255 символов',
            'id.exists' => 'dasdas'
        ];
    }
    public function failedValidation(Validator $validator)
    {
        Log::alert('errors', $validator->errors()->all());
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Ошибка валидации',
            'errors' => $validator->errors()->all()
        ], 422));
    }

    public function prepareForValidation()
    {
        if ($this->isJson()) {
            $jsonData = json_decode($this->getContent(), true);

            if (json_last_error() === JSON_ERROR_NONE) {
                $this->merge([$jsonData]);
            }
        }
    }
}
