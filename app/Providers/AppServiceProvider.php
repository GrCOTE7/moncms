<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

namespace App\Providers;

use App\Models\{Menu, Setting};
use Illuminate\Support\{Facades, ServiceProvider};
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 */
	public function register(): void
	{
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot(): void
	{
		if (!$this->app->runningInConsole()) {
			$settings = Setting::all();
			foreach ($settings as $setting) {
				config(['app.' . $setting->key => $setting->value]);
			}
		}
		Facades\View::composer(['components.layouts.app'], function (View $view) {
			$view->with(
				'menus',
				Menu::with(['submenus' => function ($query) {
					$query->orderBy('order');
				}])->orderBy('order')->get()
			);
		});
	}
}
