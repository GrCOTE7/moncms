<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

use App\Models\{Category, Post};
use Livewire\Attributes\{Layout, Validate};
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Mary\Traits\Toast;

new #[Layout('components.layouts.admin')] class extends Component {
	use WithFileUploads, Toast;

	public int $category_id;

	#[Validate('required|string|max:16777215')]
	public string $body = '';

	#[Validate('required|string|max:255')]
	public string $title = '';

	#[Validate('required|max:255|unique:posts,slug|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/')]
	public string $slug = '';

	#[Validate('required')]
	public bool $active = false;

	#[Validate('required')]
	public bool $pinned = false;

	#[Validate('required|max:70')]
	public string $seo_title = '';

	#[Validate('required|max:160')]
	public string $meta_description = '';

	#[Validate('required|regex:/^[A-Za-z0-9-éèàù]{1,50}?(,[A-Za-z0-9-éèàù]{1,50})*$/')]
	public string $meta_keywords = '';

	#[Validate('required|image|max:7000')]
	public ?TemporaryUploadedFile $photo = null;

	public function mount(): void
	{
		$category          = Category::first();
		$this->category_id = $category->id;
	}

	public function updatedTitle($value)
	{
		$this->slug      = Str::slug($value);
		$this->seo_title = $value;
	}

	public function save()
	{
		$data = $this->validate();

		$date = now()->format('Y/m');
		$path = $date . '/' . basename($this->photo->store('photos/' . $date, 'public'));

		$data['body'] = replaceAbsoluteUrlsWithRelative($data['body']);

		Post::create(
			$data + [
				'user_id'     => Auth::id(),
				'category_id' => $this->category_id,
				'image'       => $path,
			],
		);

		$this->success(__('Post added with success.'), redirectTo: '/admin/posts/index');
	}

	public function with(): array
	{
		return [
			'categories' => Category::orderBy('title')->get(),
		];
	}
};
