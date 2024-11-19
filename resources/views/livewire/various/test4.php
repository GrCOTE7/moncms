<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

use Livewire\Attributes\{Layout, Title};
use Livewire\Volt\Component;
use Livewire\WithPagination;

new
#[Layout('components.layouts.test')]
class extends Component {
	use WithPagination;

	// public function mount()
	// {
	// }

	public function with(): array {
		return [];
	}
};
