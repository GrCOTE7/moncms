<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

use App\Models\Member;
use Livewire\Volt\Component;
use Livewire\WithPagination;
use Livewire\Attributes\{Layout, Title};
use Illuminate\Pagination\LengthAwarePaginator;

new
#[Title('Test 2')]
#[Layout('components.layouts.test')]
class extends Component {
	use WithPagination;

	// public function mount()
	// {
	// }

	// Table headers
	public function headers(): array {
		return [
			['key' => 'id', 'label' => '#', 'class' => 'w-1'],
			['key' => 'name', 'label' => 'Name', 'class' => 'w-64'],
			['key' => 'username', 'label' => 'Username', 'class' => 'w-20'],
			['key' => 'email', 'label' => 'E-mail', 'sortable' => true],
		];
	}

	public function members(): LengthAwarePaginator {
		// return Member::select(['id', 'name', 'username', 'email'])
		// 	->orderBy('name')
		// 	->orderBy('username')
		// 	->paginate(2500);

		return Member::selectRaw('id, name, username, email')
			->orderBy('name')
			->orderBy('username')
			->paginate(25000);
	}

	public function with(): array {
		return [
			'members' => $this->members(),
			'headers' => $this->headers(),
		];
	}
};
