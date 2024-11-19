<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

use App\Models\{Category, Post};
use App\Repositories\PostRepository;
use Illuminate\Database\Eloquent\{Builder, Collection};
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;

new #[Layout('components.layouts.admin')] class extends Component {
	use Toast;
	use WithPagination;

	public string $search = '';
	public array $sortBy  = ['column' => 'created_at', 'direction' => 'desc'];
	public Collection $categories;
	public $category_id = 0;

	public function mount(): void {
		View::share('noHeader',true);
		$this->categories = $this->getCategories();
	}

	public function getCategories(): Collection {
		if (Auth::user()->isAdmin()) {
			return Category::all();
		}

		return Category::whereHas('posts', fn (Builder $q) => $q->where('user_id', Auth::id()))->get();
	}

	public function headers(): array {
		$headers = [['key' => 'title', 'label' => __('Title')]];

		if (Auth::user()->isAdmin()) {
			$headers = array_merge($headers, [['key' => 'user_name', 'label' => __('Author')]]);
		}

		return array_merge($headers, [['key' => 'category_title', 'label' => __('Category')], ['key' => 'comments_count', 'label' => __('')], ['key' => 'active', 'label' => __('Published')], ['key' => 'date', 'label' => __('Date')]]);
	}

	public function posts(): LengthAwarePaginator {
		return Post::query()
			->select('id', 'title', 'slug', 'category_id', 'active', 'user_id', 'created_at', 'updated_at')
			->when(Auth::user()->isAdmin(), fn (Builder $q) => $q->withAggregate('user', 'name'))
			->when(!Auth::user()->isAdmin(), fn (Builder $q) => $q->where('user_id', Auth::id()))
			->when($this->category_id, fn (Builder $q) => $q->where('category_id', $this->category_id))
			->withAggregate('category', 'title')
			->withcount('comments')
			->when($this->search, fn (Builder $q) => $q->where('title', 'like', "%{$this->search}%"))
			->when(
				'date' === $this->sortBy['column'],
				fn (Builder $q) => $q->orderBy('created_at', $this->sortBy['direction']),
				fn (Builder $q) => $q->orderBy($this->sortBy['column'], $this->sortBy['direction'])
			)
			->latest()
			->paginate(config('app.pagination', '10'));
	}

	public function deletePost(int $postId): void {
		$post = Post::findOrFail($postId);
		$post->delete();
		$this->success("{$post->title} " . __('deleted'));
	}

	public function clonePost(int $postId): void {
		$originalPost       = Post::findOrFail($postId);
		$clonedPost         = $originalPost->replicate();
		$postRepository     = new PostRepository();
		$clonedPost->slug   = $postRepository->generateUniqueSlug($originalPost->slug);
		$clonedPost->active = false;
		$clonedPost->save();

		// Ici on redirigera vers le formulaire de modification de l'article cloné
	}

	public function with(): array {
		return [
			'posts'   => $this->posts(),
			'headers' => $this->headers(),
		];
	}
};
