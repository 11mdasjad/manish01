<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => ['nullable', 'string', 'in:product,service,project,general'],
            'item_id' => ['nullable', 'integer'],
            'item_name' => ['nullable', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'company' => ['nullable', 'string', 'max:150'],
            'quantity_requirement' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'min:10', 'max:3000'],
            'website_hp' => ['nullable', 'max:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please provide your full name.',
            'email.required' => 'A valid email address is required so our trade desk can respond.',
            'phone.required' => 'Please provide a direct contact or WhatsApp phone number.',
            'message.required' => 'Please detail your requirements, specification inquiries, or site visit request.',
            'message.min' => 'Inquiry message must be at least 10 characters long.',
            'website_hp.max' => 'Automated spam submission detected.',
        ];
    }
}
