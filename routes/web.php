<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

use App\Http\Middleware\{IsAdmin, IsAdminOrRedac};
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// À chaque changement: php artisan view:clear & php artisan route:clear

Volt::route('/', 'index');
Volt::route('/test', 'test')->name('test'); // Simple component
Volt::route('/test1', 'test1')->name('test1'); // To do...
Volt::route('/test2', 'test2')->name('test2'); // Simple members list
Volt::route('/test3', 'test3')->name('test3'); // Members list with birthday
Volt::route('/users', 'users.index');

Route::get('/memo', function () {
	return view('memo');
})->name('memo');

Volt::route('/category/{slug}', 'index');

Volt::route('/search/{param}', 'index')->name('posts.search');

Volt::route('/posts/{slug}', 'posts.show')->name('posts.show');

Volt::route('/pages/{page:slug}', 'pages.show')->name('pages.show');

Volt::route('/contact', 'pages.contact')->name('pages.contact');

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
		Volt::route('/', 'admin.index')->name('admin.root');
		Volt::route('/dashboard', 'admin.index')->name('admin');
		Volt::route('/posts/index', 'admin.posts.index')->name('posts.index');
		Volt::route('/posts/create', 'admin.posts.create')->name('posts.create');
		Volt::route('/posts/{post:slug}/edit', 'admin.posts.edit')->name('posts.edit');
		Route::middleware(IsAdmin::class)->group(function () {
			Volt::route('/categories/index', 'admin.categories.index')->name('categories.index');
			Volt::route('/categories/{category}/edit', 'admin.categories.edit')->name('categories.edit');

			Volt::route('/pages/index', 'admin.pages.index')->name('pages.index');
			Volt::route('/pages/create', 'admin.pages.create')->name('pages.create');
			Volt::route('/pages/{page:slug}/edit', 'admin.pages.edit')->name('pages.edit');

			// 2do: Optimisation requête (Ici ou page test2)
			// https://www.youtube.com/watch?v=dKexOXT0oso&ab_channel=LaravelJutsu
			Volt::route('/users/index', 'admin.users.index')->name('users.index');
			Volt::route('/users/{user}/edit', 'admin.users.edit')->name('users.edit');
		});
	});
});