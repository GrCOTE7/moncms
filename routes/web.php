<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

use App\Http\Middleware\{IsAdmin, IsAdminOrRedac};
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

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
		Volt::route('/posts/index', 'admin.posts.index')->name('posts.index');
		Volt::route('/posts/create', 'admin.posts.create')->name('posts.create');
		Volt::route('/posts/{post:slug}/edit', 'admin.posts.edit')->name('posts.edit');
		Route::middleware(IsAdmin::class)->group(function () {
			Volt::route('/categories/index', 'admin.categories.index')->name('categories.index');
            Volt::route('/categories/{category}/edit', 'admin.categories.edit')->name('categories.edit');
		});
	});
});
