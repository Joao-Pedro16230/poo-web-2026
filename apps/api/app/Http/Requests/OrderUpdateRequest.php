<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_id' => ['sometimes', 'integer', 'exists:customers,id'],
            'total' => ['sometimes', 'numeric', 'min:0'],
            'status' => ['sometimes', 'string', 'max:255'],
            'paid_at' => ['sometimes', 'nullable', 'date'],
        ];
    }
}
