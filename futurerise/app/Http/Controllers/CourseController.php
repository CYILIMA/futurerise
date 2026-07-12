<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class CourseController extends Controller
{
    public function index(): View
    {
        return view('courses', [
            'courses' => Course::where('is_active', true)->orderBy('sort_order')->get(),
        ]);
    }

    public function show(Course $course): View
    {
        return view('courses.show', [
            'course' => $course,
            'isUnlocked' => (bool) session()->get('course_access_' . $course->id, false),
        ]);
    }

    public function unlock(Request $request, Course $course): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'string', 'min:4'],
        ]);

        if (! Hash::check($request->input('password'), $course->access_password)) {
            return back()->withErrors(['password' => 'The password you entered is incorrect.']);
        }

        session()->put('course_access_' . $course->id, true);

        return redirect()->route('courses.show', $course)->with('status', 'Access granted.');
    }
}
