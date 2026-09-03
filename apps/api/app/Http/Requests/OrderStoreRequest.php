<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_id' => ['required', 'integer', 'exists:customers,id'],
            'total' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'string', 'max:255'],
            'paid_at' => ['nullable', 'date'],
        ];
    }
}