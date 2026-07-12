<?php

namespace App\Http\Controllers;

use App\Models\SiteLogo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminLogoController extends Controller
{
    public function edit(): View
    {
        return view('admin.logo.edit', [
            'logo' => SiteLogo::latest()->first(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'logo' => ['required', 'image', 'max:5120'],
        ]);

        $logo = SiteLogo::latest()->first();

        if ($request->hasFile('logo')) {
            if ($logo?->image_path) {
                Storage::disk('public')->delete($logo->image_path);
            }

            $imagePath = $request->file('logo')->store('logos', 'public');

            if ($logo) {
                $logo->update(['image_path' => $imagePath]);
            } else {
                SiteLogo::create(['image_path' => $imagePath]);
            }
        }

        return redirect()->route('admin.logo.edit')->with('status', 'Logo updated successfully.');
    }
}
