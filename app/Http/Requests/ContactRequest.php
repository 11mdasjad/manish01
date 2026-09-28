<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'company' => ['nullable', 'string', 'max:150'],
            'subject' => ['nullable', 'string', 'max:200'],
            'message' => ['required', 'string', 'min:10', 'max:3000'],
            'website_hp' => ['nullable', 'max:0'], // Honeypot field for bot/spam prevention
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please provide your full name or company representative name.',
            'email.required' => 'A valid corporate email address is required.',
            'email.email' => 'Please provide an authentic email format (e.g. name@company.com).',
            'message.required' => 'Please include your message or inquiry brief.',
            'message.min' => 'Your inquiry message must be at least 10 characters long.',
            'website_hp.max' => 'Automated spam submission detected.',
        ];
    }
}
