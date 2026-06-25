<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
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

Route::get('/donate', function () {
    return view('donate');
})->name('donate');
