<?php

namespace App\Http\Controllers;

use App\Models\SocialLink;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminSocialController extends Controller
{
    public function index(): View
    {
        return view('admin.social.index', [
            'platforms' => SocialLink::DEFAULT_PLATFORMS,
            'socialLinks' => SocialLink::orderBy('sort_order')->get()->keyBy('platform'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'social_links' => ['nullable', 'array'],
            'social_links.*' => ['nullable', 'url', 'max:500'],
        ]);

        $platforms = SocialLink::DEFAULT_PLATFORMS;
        $sortOrder = 1;

        foreach ($platforms as $platformKey => $platformName) {
            $url = trim((string) ($validated['social_links'][$platformKey] ?? ''));

            SocialLink::updateOrCreate(
                ['platform' => $platformName],
                [
                    'url' => $url,
                    'sort_order' => $sortOrder,
                    'is_active' => $url !== '',
                ]
            );

            $sortOrder++;
        }

        return redirect()->route('admin.social.index')->with('status', 'Social media links saved successfully.');
    }

    public function update(Request $request, SocialLink $socialLink): RedirectResponse
    {
        $validated = $request->validate([
            'url' => ['nullable', 'url', 'max:500'],
        ]);

        $socialLink->update([
            'url' => trim((string) ($validated['url'] ?? '')),
            'is_active' => ! empty($validated['url']),
        ]);

        return redirect()->route('admin.social.index')->with('status', 'Social link updated successfully.');
    }

    public function destroy(SocialLink $socialLink): RedirectResponse
    {
        $socialLink->delete();

        return redirect()->route('admin.social.index')->with('status', 'Social link removed successfully.');
    }
}
