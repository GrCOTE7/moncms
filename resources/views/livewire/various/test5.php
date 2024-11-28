<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

ini_set('memory_limit', '8G'); // Augmenter la limite de mémoire à 256 Mo

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use App\Models\{User};
use Illuminate\Support\{Benchmark};
use Livewire\Attributes\{Layout};
use Livewire\Volt\Component;

new
#[Layout('components.layouts.test')]
class extends Component {
	public $data;

	public function mount() {
		// $user = (User::whereId(1))->get()->dd();
		// $user = User::find(2);

		// Log::info(User::where('name', 'admin')->toSql());

		// $this->data = $this->getUser($user);

		// echo Benchmark::measure(fn () => Order::all())

		// Log::info('Time', [
		// 	'Time getUser()' => Benchmark::measure(fn () => $this->getUser($user)),
		// ]);

	}

	public function confirm() {
		Log::info('Ready');
	}

	public function getUser(User $user) {
		// composer require barryvdh/laravel-ide-helper
		// php artisan ide-helper:models
		// php artisan ide-helper:models -M
		// php artisan ide-helper:generate

		Log::withContext(['getUser() In' => $user]);
		Log::withContext(['getUser() Out' => [$user->name, $user->email]]);

		return [$user->name, $user->email];
		// dd($post);
	}

	public function with(): array {
		return [];
	}
};

function nf($n, $dec = 0) {
	return number_format($n, $dec, ',', ' ');
}
