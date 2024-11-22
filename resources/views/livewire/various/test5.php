<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

use App\Models\Post;
use Livewire\Attributes\{Layout};
use Livewire\Volt\Component;
use Livewire\WithPagination;

new
#[Layout('components.layouts.test')]
class extends Component {
	use WithPagination;

	public $data;

	public function mount() {
		$this->data = $this->getUser();
	}

	public function getUser() {
		return Post::findOrFail(7)->user->name;
		// dd($post);
	}

	public function with(): array {
		return [];
	}
};
