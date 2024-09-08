<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Volt::route('/', 'users.index');

Route::middleware('guest')->group(function () {
	Volt::route('/register', 'auth.register');
	Volt::route('/login', 'auth.login')->name('login');
	Volt::route('/forgot-password', 'auth.forgot-password');
	Volt::route('/reset-password/{token}', 'auth.reset-password')->name('password.reset');
});
