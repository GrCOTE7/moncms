<?php

use App\Models\Page;
use illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Mary\Traits\Toast;

new #[Layout('components.layouts.admin')] class extends Component {
	use Toast;

	public Page $page;
	public string $body             = '';
	public string $title            = '';
	public string $slug             = '';
	public bool $active             = false;
	public string $seo_title        = '';
	public string $meta_description = '';
	public string $meta_keywords    = '';

	public function mount(Page $page): void {
		$this->page = $page;
		$this->fill($this->page);
	}

	public function updatedTitle($value): void {
		$this->generateSlug($value);
	}

	public function save() {
		$data = $this->validate([
			'title'            => 'required|string|max:255',
			'body'             => 'required|max:65000',
			'active'           => 'required',
			'slug'             => ['required', 'string', 'max:255', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', Rule::unique('pages')->ignore($this->page->id)],
			'seo_title'        => 'required|max:70',
			'meta_description' => 'required|max:160',
			'meta_keywords'    => 'required|regex:/^[A-Za-z0-9-éèàù]{1,50}?(,[A-Za-z0-9-éèàù]{1,50})*$/',
		]);

		$this->page->update($data);

		$this->success(__('Page edited with success.'), redirectTo: '/admin/pages/index');
	}

	private function generateSlug(string $title): void {
		$this->slug = Str::of($title)->slug('-');
	}
}; ?>

@section('title', __('Edit a page'))
<div>
    @include('livewire.admin.pages.page-form')
</div>
