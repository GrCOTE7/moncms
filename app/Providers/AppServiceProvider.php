<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

namespace App\Providers;

use Illuminate\View\View;
use Illuminate\Support\Str;
use App\Models\{Menu, Setting};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\{Facades, ServiceProvider};

class AppServiceProvider extends ServiceProvider {
	/**
	 * Register any application services.
	 */
	public function register(): void {
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot(): void {
		if (!$this->app->runningInConsole()) {
			$settings = Setting::all();
			foreach ($settings as $setting) {
				config(['app.' . $setting->key => $setting->value]);
			}
		}
        // lOG ALL SQL requests ( As Debugbar )
        // if (App::environment('local')) {
        // DB::listen(function ($query) {
        //     logger(Str::replaceArray('?', $query->bindings, $query->sql));
        // });
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
