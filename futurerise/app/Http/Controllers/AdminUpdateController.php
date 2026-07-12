<?php

namespace App\Http\Controllers;

use App\Models\WebsiteUpdate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminUpdateController extends Controller
{
    public function index(): View
    {
        return view('admin.updates.index', [
            'updates' => WebsiteUpdate::latest()->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('admin.updates.create', [
            'update' => new WebsiteUpdate(['is_published' => true]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('updates', 'public');
        }

        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] = $data['is_published'] ? now() : null;

        WebsiteUpdate::create($data);

        return redirect()->route('admin.dashboard')->with('status', 'Update published successfully.');
    }

    public function edit(WebsiteUpdate $websiteUpdate): View
    {
        return view('admin.updates.edit', [
            'update' => $websiteUpdate,
        ]);
    }

    public function update(Request $request, WebsiteUpdate $websiteUpdate): RedirectResponse
    {
        $data = $this->validatedData($request);

        if ($request->hasFile('image')) {
            if ($websiteUpdate->image_path) {
                Storage::disk('public')->delete($websiteUpdate->image_path);
            }

            $data['image_path'] = $request->file('image')->store('updates', 'public');
        }

        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] = $data['is_published']
            ? ($websiteUpdate->published_at ?? now())
            : null;

        $websiteUpdate->update($data);

        return redirect()->route('admin.dashboard')->with('status', 'Update saved successfully.');
    }

    public function destroy(WebsiteUpdate $websiteUpdate): RedirectResponse
    {
        if ($websiteUpdate->image_path) {
            Storage::disk('public')->delete($websiteUpdate->image_path);
        }

        $websiteUpdate->delete();

        return redirect()->route('admin.dashboard')->with('status', 'Update deleted.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:140'],
            'summary' => ['nullable', 'string', 'max:240'],
            'body' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);
    }
}
