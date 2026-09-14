<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class InvoiceRequest extends FormRequest
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
            'customer_id' => 'required',
            'invoice_date' => 'required|date',
            'due_date' => [
                'required',
                'date',
                'after:' . now()->addDay(),
            ],
            'items' => 'required',
            'discount' => 'required|between:0,100',
        ];
    }

    public function messages()
    {
        return [
            'items.required' => 'At least should contain 1 item',
            'due_date.after' => "the date should be start from tomorrow",
        ];
    }
}