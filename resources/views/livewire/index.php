<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

use App\Models\Category;
use Livewire\Volt\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use App\Repositories\PostRepository;
use Illuminate\Pagination\LengthAwarePaginator;

new
#[Title('Accueil')]
class extends Component {
	use WithPagination;

	public ?Category $category = null;
	public string $param       = '';

	public function mount(string $slug = '', string $param = ''): void
	{
		$this->param = $param;

		if (request()->is('category/*')) {
			$this->category = $this->getCategoryBySlug($slug);
		}
	}

	public function getPosts(): LengthAwarePaginator
	{
		$postRepository = new PostRepository();

		if (!empty($this->param)) {
			return $postRepository->search($this->param);
		}

		return $postRepository->getPostsPaginate($this->category);
	}

	public function with(): array
	{
		return ['posts' => $this->getPosts()];
	}

	protected function getCategoryBySlug(string $slug): ?Category
	{
		return 'category' === request()->segment(1) ? Category::whereSlug($slug)->firstOrFail() : null;
	}
};
