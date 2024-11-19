<x-form wire:submit="save">
    <x-input label="{{ __('Title') }}" wire:model.debounce.500ms="title" wire:change="$refresh" />
    <x-input type="text" wire:model="slug" label="{{ __('Slug') }}" />
    <x-slot:actions>
        <x-helpers.cancel-save-btns :lk="route('comments.index')" />
    </x-slot:actions>
</x-form>
