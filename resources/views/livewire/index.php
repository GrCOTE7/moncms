<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

use App\Models\Category;
use App\Repositories\PostRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new class() extends Component {
	use WithPagination;

	public ?Category $category = null;
	public string $param       = '';
	public bool $favorites     = false;

	/**
	 * Méthode de montage initiale appelée lors de la création du composant.
	 *
	 * @param string $slug  Slug pour identifier une catégorie ou une série
	 * @param string $param Paramètre de recherche optionnel
	 */
	public function mount(string $slug = '', string $param = ''): void {
		$this->param = $param;

		if (request()->is('category/*')) {
			$this->category = $this->getCategoryBySlug($slug);
		} elseif (request()->is('favorites')) {
			$this->favorites = true;
		}
	}

	public function getPosts(): LengthAwarePaginator {
		$postRepository = new PostRepository();

		if (!empty($this->param)) {
			return $postRepository->search($this->param);
		}

		if ($this->favorites) {
			return $postRepository->getFavoritePosts(auth()->user());
		}

		return $postRepository->getPostsPaginate($this->category);
	}

	public function with(): array {
		return ['posts' => $this->getPosts()];
	}

	protected function getCategoryBySlug(string $slug): ?Category {
		return 'category' === request()->segment(1) ? Category::whereSlug($slug)->firstOrFail() : null;
	}
};
