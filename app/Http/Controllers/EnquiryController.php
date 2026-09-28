<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnquiryRequest;
use App\Models\Enquiry;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EnquiryController extends Controller
{
    public function store(EnquiryRequest $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validated();

        $enquiry = Enquiry::create([
            'type' => $validated['type'] ?? 'product',
            'item_id' => $validated['item_id'] ?? null,
            'item_name' => $validated['item_name'] ?? null,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'company' => $validated['company'] ?? null,
            'quantity_requirement' => $validated['quantity_requirement'] ?? null,
            'message' => $validated['message'],
            'status' => 'pending',
        ]);

        Log::info("Commercial RFQ / Enquiry Registered: #{$enquiry->id} for '{$enquiry->item_name}' by {$enquiry->name}");

        $successText = 'Your Request for Quotation (RFQ) has been logged. Our commercial trade desk will review your specification and issue a formal proposal promptly.';

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $successText,
                'reference_no' => 'HM-RFQ-' . str_pad($enquiry->id, 5, '0', STR_PAD_LEFT),
            ]);
        }

        return redirect()->back()->with('success', $successText);
    }
}
