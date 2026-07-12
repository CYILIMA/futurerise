<?php

namespace App\Http\Controllers;

use App\Models\DonationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:180'],
            'phone' => ['nullable', 'string', 'max:40'],
            'donation_type' => ['required', 'string', 'max:60'],
            'amount' => ['nullable', 'string', 'max:60'],
            'message' => ['nullable', 'string', 'max:2000'],
        ]);

        DonationRequest::create($validated);

        return redirect()->route('donate')->with('status', 'Thank you for your interest. The Future Rise Foundation team will contact you soon.');
    }
}
