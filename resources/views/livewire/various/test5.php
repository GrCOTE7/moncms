<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

use App\Models\{User};
use Illuminate\Support\Benchmark;
use Livewire\Attributes\{Layout};
use Livewire\Volt\Component;
use Livewire\WithPagination;

new
#[Layout('components.layouts.test')]
class extends Component {
	use WithPagination;

	public $data;

	public function mount() {
		// $user = (User::whereId(1))->get()->dd();
		$user = User::find(1);

		$this->data = $this->getUser($user);

		// echo Benchmark::measure(fn () => Order::all())


		Log::info('Time', [
            'Time getUser()' => Benchmark::measure(fn () => $this->getUser($user))
            ]);

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
