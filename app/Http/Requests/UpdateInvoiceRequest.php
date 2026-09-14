<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class UpdateInvoiceRequest extends FormRequest
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
            'discount' => 'required|between:0,100',
            'status' => 'required|integer|in:0,1,4',
        ];
    }

    public function messages()
    {
        return [
            'due_date.after' => "the date should be start from tomorrow",
        ];
    }
}