<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdminOrRedac;

Volt::route('/', 'index');
Volt::route('/test', 'test')->name('test');

Route::get('/uuu', function () {
	return view('uuu');
})->name('uuu');

Volt::route('/category/{slug}', 'index');
Volt::route('/posts/{slug}', 'posts.show')->name('posts.show');
Volt::route('/search/{param}', 'index')->name('posts.search');

Volt::route('/users', 'users.index');

Route::middleware('guest')->group(function () {
	Volt::route('/register', 'auth.register');
	Volt::route('/login', 'auth.login')->name('login');
	Volt::route('/forgot-password', 'auth.forgot-password');
	Volt::route('/reset-password/{token}', 'auth.reset-password')->name('password.reset');
});

Route::middleware('auth')->group(function () {
	Volt::route('/profile', 'auth.profile')->name('profile');
	Volt::route('/favorites', 'index')->name('posts.favorites');
	Route::middleware(IsAdminOrRedac::class)->prefix('admin')->group(function () {
		Volt::route('/dashboard', 'admin.index')->name('admin');
	});
});
