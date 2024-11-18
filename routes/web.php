<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

use App\Http\Middleware\{IsAdmin, IsAdminOrRedac};
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// À chaque changement: php artisan view:clear & php artisan route:clear

Volt::route('/', 'index')->name('home');

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

		Volt::route('/comments/index', 'admin.comments.index')->name('comments.index');
		Volt::route('/comments/{comment}/edit', 'admin.comments.edit')->name('comments.edit');

		Route::middleware(IsAdmin::class)->group(function () {
			Volt::route('/categories/index', 'admin.categories.index')->name('categories.index');
			Volt::route('/categories/{category}/edit', 'admin.categories.edit')->name('categories.edit');

			Volt::route('/contacts/index', 'admin.contacts.index')->name('contacts.index');

			Volt::route('/users/index', 'admin.users.index')->name('users.index');
			Volt::route('/users/{user}/edit', 'admin.users.edit')->name('users.edit');

			Volt::route('/pages/index', 'admin.pages.index')->name('pages.index');
			Volt::route('/pages/create', 'admin.pages.create')->name('pages.create');
			Volt::route('/pages/{page:slug}/edit', 'admin.pages.edit')->name('pages.edit');

			Volt::route('/menus/index', 'admin.menus.index')->name('menus.index');
			Volt::route('/menus/{menu}/edit', 'admin.menus.edit')->name('menus.edit');
			Volt::route('/submenus/{submenu}/edit', 'admin.menus.editsub')->name('submenus.edit');
			Volt::route('/footers/index', 'admin.menus.footers')->name('menus.footers');
			Volt::route('/footers/{footer}/edit', 'admin.menus.editfooter')->name('footers.edit');

			Volt::route('/images/index', 'admin.images.index')->name('images.index');
			Volt::route('/images/{year}/{month}/{id}/edit', 'admin.images.edit')->name('images.edit');

			Volt::route('/settings', 'admin.settings')->name('settings');

			Volt::route('/test', 'various.test')->name('various.test'); // Simple component
			Volt::route('/test1', 'various.test1')->name('various.test1'); // Ready...
			Volt::route('/test2', 'various.test2')->name('various.test2'); // Simple members list
			Volt::route('/test3', 'various.test3')->name('various.test3'); // Members list with birthday
			Volt::route('/test4', 'various.test4')->name('various.test4'); // Members list with birthday
			Volt::route('/users', 'users.index');
		});
	});
});
