<?php

namespace App\Http\Controllers;

use App\Models\SiteBackground;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminBackgroundController extends Controller
{
    public function edit(): View
    {
        return view('admin.background.edit', [
            'background' => SiteBackground::latest()->first(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'background' => ['required', 'image', 'max:10240'],
        ]);

        $background = SiteBackground::latest()->first();

        if ($background?->image_path) {
            Storage::disk('public')->delete($background->image_path);
        }

        $imagePath = $request->file('background')->store('backgrounds', 'public');

        if ($background) {
            $background->update(['image_path' => $imagePath]);
        } else {
            SiteBackground::create(['image_path' => $imagePath]);
        }

        return redirect()->route('admin.background.edit')->with('status', 'Website background updated successfully.');
    }
}
