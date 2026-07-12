<?php

namespace App\Http\Controllers;

use App\Models\DonationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminDonationController extends Controller
{
    public function index(): View
    {
        return view('admin.donations.index', [
            'donations' => DonationRequest::latest()->paginate(12),
        ]);
    }

    public function update(Request $request, DonationRequest $donationRequest): RedirectResponse
    {
        $request->validate([
            'is_contacted' => ['nullable', 'boolean'],
        ]);

        $donationRequest->update([
            'is_contacted' => $request->boolean('is_contacted'),
        ]);

        return redirect()->route('admin.donations.index')->with('status', 'Donation request updated successfully.');
    }
}
