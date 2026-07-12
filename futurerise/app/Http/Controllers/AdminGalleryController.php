<?php

namespace App\Http\Controllers;

use App\Models\GalleryPhoto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminGalleryController extends Controller
{
    public function index(): View
    {
        return view('admin.gallery.index', [
            'photos' => GalleryPhoto::orderBy('sort_order')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'photo' => ['required', 'image', 'max:5120'],
            'caption' => ['nullable', 'string', 'max:140'],
        ]);

        $imagePath = $request->file('photo')->store('gallery', 'public');

        GalleryPhoto::create([
            'image_path' => $imagePath,
            'caption' => $request->input('caption'),
            'sort_order' => GalleryPhoto::max('sort_order') + 1,
        ]);

        return redirect()->route('admin.gallery.index')->with('status', 'Photo uploaded successfully.');
    }

    public function update(Request $request, GalleryPhoto $galleryPhoto): RedirectResponse
    {
        $request->validate([
            'caption' => ['nullable', 'string', 'max:140'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $galleryPhoto->update([
            'caption' => $request->input('caption'),
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.gallery.index')->with('status', 'Photo updated successfully.');
    }

    public function destroy(GalleryPhoto $galleryPhoto): RedirectResponse
    {
        Storage::disk('public')->delete($galleryPhoto->image_path);
        $galleryPhoto->delete();

        return redirect()->route('admin.gallery.index')->with('status', 'Photo deleted successfully.');
    }
}
