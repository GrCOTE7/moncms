<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

use App\Models\User;
use Livewire\Attributes\{Layout};
use Livewire\Volt\Component;
use Livewire\WithPagination;

new
#[Layout('components.layouts.test')]
class extends Component {
	use WithPagination;

	public function mount() {
		$user = User::find(1);
		echo $user->role;
	}

	public function with(): array {
		return [];
	}
};
