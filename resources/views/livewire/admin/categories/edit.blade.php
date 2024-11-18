<?php

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Mary\Traits\Toast;

new #[Layout('components.layouts.admin')] class extends Component {
    use Toast;

    public Category $category;
    public string $title = '';
    public string $slug = '';

    public function mount(Category $category): void
    {
        $this->category = $category;
        $this->fill($this->category->toArray());
    }

    public function updatedTitle($value): void
    {
        $this->generateSlug($value);
    }

    public function save(): void
    {
        $data = $this->validate($this->rules());
        $this->category->update($data);
        $this->success(__('Category updated successfully.'), redirectTo: '/admin/categories/index');
    }

    protected function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => ['required', 'string', 'max:255', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', Rule::unique('categories')->ignore($this->category->id)],
        ];
    }

    private function generateSlug(string $title): void
    {
        $this->slug = Str::of($title)->slug('-');
    }
}; ?>

@section('title', __('Edit a category'))
<div>
    <x-helpers.header-lk title="{{ __('Edit a category') }}" />
    <x-card>
        @include('livewire.admin.categories.category-form')
    </x-card>
    <x-helpers.progress-bar />
</div>
