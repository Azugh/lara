<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CartItemUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'sign' => 'required|string|in:increase,decrease',
        ];
    }

    public function prepareForValidation(): void
    {
        if ($this->isJson()) {
            $jsonData = json_decode($this->getContent(), true);

            if (json_last_error() === JSON_ERROR_NONE) {
                $this->merge([$jsonData]);
            }
        }
    }
}
