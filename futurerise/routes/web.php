<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminBackgroundController;
use App\Http\Controllers\AdminCourseController;
use App\Http\Controllers\AdminDonationController;
use App\Http\Controllers\AdminGalleryController;
use App\Http\Controllers\AdminLogoController;
use App\Http\Controllers\AdminSocialController;
use App\Http\Controllers\AdminTeamController;
use App\Http\Controllers\AdminUpdateController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DonationController;
use App\Models\Course;
use App\Models\GalleryPhoto;
use App\Models\SocialLink;
use App\Models\TeamMember;
use App\Models\WebsiteUpdate;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', [
        'updates' => WebsiteUpdate::published()->latest('published_at')->take(3)->get(),
        'galleryPhotos' => GalleryPhoto::where('is_active', true)->orderBy('sort_order')->get(),
    ]);
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/funding', function () {
    return view('funding');
})->name('funding');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/team', function () {
    return view('team', [
        'teamMembers' => TeamMember::where('is_active', true)->orderBy('sort_order')->get(),
    ]);
})->name('team');

Route::controller(CourseController::class)->group(function () {
    Route::get('/courses', 'index')->name('courses');
    Route::get('/courses/{course}', 'show')->name('courses.show');
    Route::post('/courses/{course}/unlock', 'unlock')->name('courses.unlock');
});

Route::get('/donate', function () {
    return view('donate');
})->name('donate');

Route::post('/donate', [DonationController::class, 'store'])->name('donate.store');

Route::get('/updates', function () {
    return view('updates', [
        'updates' => WebsiteUpdate::published()->latest('published_at')->paginate(9),
    ]);
})->name('updates');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'create'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'store'])->name('login.store');
    Route::post('/logout', [AdminAuthController::class, 'destroy'])->name('logout');

    Route::middleware('admin.auth')->group(function () {
        Route::get('/', [AdminUpdateController::class, 'index'])->name('dashboard');
        Route::get('/updates/create', [AdminUpdateController::class, 'create'])->name('updates.create');
        Route::post('/updates', [AdminUpdateController::class, 'store'])->name('updates.store');
        Route::get('/updates/{websiteUpdate}/edit', [AdminUpdateController::class, 'edit'])->name('updates.edit');
        Route::put('/updates/{websiteUpdate}', [AdminUpdateController::class, 'update'])->name('updates.update');
        Route::delete('/updates/{websiteUpdate}', [AdminUpdateController::class, 'destroy'])->name('updates.destroy');

        Route::get('/logo', [AdminLogoController::class, 'edit'])->name('logo.edit');
        Route::put('/logo', [AdminLogoController::class, 'update'])->name('logo.update');
        Route::get('/background', [AdminBackgroundController::class, 'edit'])->name('background.edit');
        Route::put('/background', [AdminBackgroundController::class, 'update'])->name('background.update');

        Route::get('/gallery', [AdminGalleryController::class, 'index'])->name('gallery.index');
        Route::post('/gallery', [AdminGalleryController::class, 'store'])->name('gallery.store');
        Route::put('/gallery/{galleryPhoto}', [AdminGalleryController::class, 'update'])->name('gallery.update');
        Route::delete('/gallery/{galleryPhoto}', [AdminGalleryController::class, 'destroy'])->name('gallery.destroy');

        Route::get('/team', [AdminTeamController::class, 'index'])->name('team.index');
        Route::post('/team', [AdminTeamController::class, 'store'])->name('team.store');
        Route::get('/team/{teamMember}/edit', [AdminTeamController::class, 'edit'])->name('team.edit');
        Route::put('/team/{teamMember}', [AdminTeamController::class, 'update'])->name('team.update');
        Route::delete('/team/{teamMember}', [AdminTeamController::class, 'destroy'])->name('team.destroy');

        Route::get('/courses', [AdminCourseController::class, 'index'])->name('courses.index');
        Route::post('/courses', [AdminCourseController::class, 'store'])->name('courses.store');
        Route::get('/courses/{course}/edit', [AdminCourseController::class, 'edit'])->name('courses.edit');
        Route::put('/courses/{course}', [AdminCourseController::class, 'update'])->name('courses.update');
        Route::delete('/courses/{course}', [AdminCourseController::class, 'destroy'])->name('courses.destroy');

        Route::get('/donations', [AdminDonationController::class, 'index'])->name('donations.index');
        Route::put('/donations/{donationRequest}', [AdminDonationController::class, 'update'])->name('donations.update');

        Route::get('/social', [AdminSocialController::class, 'index'])->name('social.index');
        Route::post('/social', [AdminSocialController::class, 'store'])->name('social.store');
        Route::put('/social/{socialLink}', [AdminSocialController::class, 'update'])->name('social.update');
        Route::delete('/social/{socialLink}', [AdminSocialController::class, 'destroy'])->name('social.destroy');
    });
});
