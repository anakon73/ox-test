<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'client_id' => 'required|exists:clients,id',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'status' => 'required|string|in:pending,completed,cancelled',
            'due_date' => 'nullable|date',
        ];
    }
}
