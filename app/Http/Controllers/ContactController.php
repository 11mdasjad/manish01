<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\ContactMessage;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('pages.contact');
    }

    public function store(ContactRequest $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validated();

        $message = ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'company' => $validated['company'] ?? null,
            'subject' => $validated['subject'] ?? 'General Corporate Inquiry',
            'message' => $validated['message'],
            'is_read' => false,
            'ip_address' => $request->ip(),
        ]);

        Log::info("Corporate Contact Form Submitted: #{$message->id} by {$message->name} <{$message->email}>");

        $successText = 'Thank you for contacting HarshMais Global Group. Your inquiry has been routed to our corporate relations desk and an executive will respond within 24 business hours.';

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $successText,
                'data' => [
                    'id' => $message->id,
                    'reference' => 'HM-INQ-' . str_pad($message->id, 5, '0', STR_PAD_LEFT),
                ]
            ]);
        }

        return redirect()->back()->with('success', $successText);
    }
}
