<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ImportCreateRequest extends FormRequest
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
            'supplier' => 'required|exists:suppliers,name',
            'external_import_id' => 'required|string',
            'sent_at' => 'required|date_format:Y-m-d\TH:i:s\Z',
            'offers' => 'required|array|min:1',
            'offers.*.external_id' => 'required|string',
            'offers.*.property.code' => 'required|string',
            'offers.*.property.name' => 'required|string',
            'offers.*.property.city' => 'required|string',
            'offers.*.check_in' => 'required|date',
            'offers.*.check_out' => 'required|date',
            'offers.*.max_guests' => 'required|integer',
            'offers.*.price' => 'required|numeric|decimal:0,2',
            'offers.*.currency' => 'required|string',
            'offers.*.available_units' => 'required|integer',
            'offers.*.expires_at' => 'required|date_format:Y-m-d\TH:i:s\Z',
        ];
    }
}
