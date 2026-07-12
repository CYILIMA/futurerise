<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminCourseController extends Controller
{
    public function index(): View
    {
        return view('admin.courses.index', [
            'courses' => Course::orderBy('sort_order')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'summary' => ['required', 'string', 'max:220'],
            'description' => ['required', 'string', 'max:3000'],
            'access_password' => ['required', 'string', 'min:4', 'max:100'],
            'notes' => ['nullable', 'string', 'max:4000'],
            'video_url' => ['nullable', 'url', 'max:500'],
            'resource_links' => ['nullable', 'string', 'max:2000'],
            'image' => ['nullable', 'image', 'max:2048'],
            'attachment' => ['nullable', 'file', 'max:10240'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $imagePath = null;
        $attachmentPath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('courses/images', 'public');
        }

        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('courses/attachments', 'public');
        }

        Course::create([
            'title' => $validated['title'],
            'summary' => $validated['summary'],
            'description' => $validated['description'],
            'access_password' => Hash::make($validated['access_password']),
            'notes' => $validated['notes'] ?? null,
            'video_url' => $validated['video_url'] ?? null,
            'resource_links' => $validated['resource_links'] ?? null,
            'image_path' => $imagePath,
            'attachment_path' => $attachmentPath,
            'sort_order' => Course::max('sort_order') + 1,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.courses.index')->with('status', 'Course created successfully.');
    }

    public function update(Request $request, Course $course): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'summary' => ['required', 'string', 'max:220'],
            'description' => ['required', 'string', 'max:3000'],
            'access_password' => ['required', 'string', 'min:4', 'max:100'],
            'notes' => ['nullable', 'string', 'max:4000'],
            'video_url' => ['nullable', 'url', 'max:500'],
            'resource_links' => ['nullable', 'string', 'max:2000'],
            'image' => ['nullable', 'image', 'max:2048'],
            'attachment' => ['nullable', 'file', 'max:10240'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $imagePath = $course->image_path;
        $attachmentPath = $course->attachment_path;

        if ($request->hasFile('image')) {
            if ($course->image_path) {
                Storage::disk('public')->delete($course->image_path);
            }

            $imagePath = $request->file('image')->store('courses/images', 'public');
        }

        if ($request->hasFile('attachment')) {
            if ($course->attachment_path) {
                Storage::disk('public')->delete($course->attachment_path);
            }

            $attachmentPath = $request->file('attachment')->store('courses/attachments', 'public');
        }

        $course->update([
            'title' => $validated['title'],
            'summary' => $validated['summary'],
            'description' => $validated['description'],
            'access_password' => Hash::make($validated['access_password']),
            'notes' => $validated['notes'] ?? null,
            'video_url' => $validated['video_url'] ?? null,
            'resource_links' => $validated['resource_links'] ?? null,
            'image_path' => $imagePath,
            'attachment_path' => $attachmentPath,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.courses.index')->with('status', 'Course updated successfully.');
    }

    public function destroy(Course $course): RedirectResponse
    {
        if ($course->image_path) {
            Storage::disk('public')->delete($course->image_path);
        }

        if ($course->attachment_path) {
            Storage::disk('public')->delete($course->attachment_path);
        }

        $course->delete();

        return redirect()->route('admin.courses.index')->with('status', 'Course removed successfully.');
    }
}
