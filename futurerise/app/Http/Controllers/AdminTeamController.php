<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminTeamController extends Controller
{
    public function index(): View
    {
        return view('admin.team.index', [
            'teamMembers' => TeamMember::orderBy('sort_order')->get(),
        ]);
    }

    public function edit(TeamMember $teamMember): View
    {
        return view('admin.team.edit', compact('teamMember'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'role' => ['required', 'string', 'max:120'],
            'background' => ['required', 'string', 'max:2000'],
            'image' => ['nullable', 'image', 'max:2048'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('team', 'public');
        }

        TeamMember::create([
            'name' => $validated['name'],
            'role' => $validated['role'],
            'background' => $validated['background'],
            'image_path' => $imagePath,
            'sort_order' => TeamMember::max('sort_order') + 1,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.team.index')->with('status', 'Staff member added successfully.');
    }

    public function update(Request $request, TeamMember $teamMember): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'role' => ['required', 'string', 'max:120'],
            'background' => ['required', 'string', 'max:2000'],
            'image' => ['nullable', 'image', 'max:2048'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $imagePath = $teamMember->image_path;

        if ($request->hasFile('image')) {
            if ($teamMember->image_path) {
                Storage::disk('public')->delete($teamMember->image_path);
            }

            $imagePath = $request->file('image')->store('team', 'public');
        }

        $teamMember->update([
            'name' => $validated['name'],
            'role' => $validated['role'],
            'background' => $validated['background'],
            'image_path' => $imagePath,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.team.index')->with('status', 'Staff member updated successfully.');
    }

    public function destroy(TeamMember $teamMember): RedirectResponse
    {
        if ($teamMember->image_path) {
            Storage::disk('public')->delete($teamMember->image_path);
        }

        $teamMember->delete();

        return redirect()->route('admin.team.index')->with('status', 'Staff member removed successfully.');
    }
}
