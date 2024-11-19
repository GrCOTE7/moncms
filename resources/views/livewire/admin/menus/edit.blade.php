<?php
use App\Models\Menu;
use Illuminate\Validation\Rule;
use Livewire\Attributes\{Layout, Title};
use Livewire\Volt\Component;
use Mary\Traits\Toast;

new #[Layout('components.layouts.admin')] class extends Component {
    use Toast;

    public Menu $menu;
    public string $label = '';
    public ?string $link = null;

    public function mount(Menu $menu): void
    {
        $this->menu = $menu;
        $this->fill($this->menu);
    }

    public function save(): void
    {
        $data = $this->validate([
            'label' => ['required', 'string', 'max:255', Rule::unique('menus')->ignore($this->menu->id)],
            'link' => 'nullable|regex:/\/([a-z0-9_-]\/*)*[a-z0-9_-]*/',
        ]);

        $this->menu->update($data);

        $this->success(__('Menu updated with success.'), redirectTo: '/admin/menus/index');
    }
}; ?>

@section('title', __('Edit a menu'))
<div>
    <x-card>
        <x-form wire:submit="save">
            <x-input label="{{ __('Title') }}" wire:model="label" />
            <x-input type="text" wire:model="link" label="{{ __('Link') }}" />
            <x-slot:actions>
                <x-helpers.cancel-save-btns :lk="route('menus.index')" />
            </x-slot:actions>
        </x-form>
    </x-card>
    <x-helpers.progress-bar />
</div>
