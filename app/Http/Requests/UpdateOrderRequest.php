<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'client_id' => 'sometimes|exists:clients,id',
            'description' => 'sometimes|string|max:255',
            'amount' => 'sometimes|numeric',
            'status' => 'sometimes|string|in:pending,completed,cancelled',
            'due_date' => 'nullable|date',
        ];
    }
}
