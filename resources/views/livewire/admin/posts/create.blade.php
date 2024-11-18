<?php
include_once 'create.php';
?>

<div>
    @section('title', __('Add a post'))

    <x-helpers.header-lk title="{{ __('Add a post') }}" />

    <x-card>
        <x-form wire:submit="save">
            <x-select label="{{ __('Category') }}" option-label="title" :options="$categories" wire:model="category_id"
                wire:change="$refresh" />
            <br>
            <div class="flex gap-6">
                <x-checkbox label="{{ __('Published') }}" wire:model="active" />
                <x-checkbox label="{{ __('Pinned') }}" wire:model="pinned" />
            </div>
            <x-input type="text" wire:model="title" label="{{ __('Title') }}"
                placeholder="{{ __('Enter the title') }}" wire:change="$refresh" />
            <x-input type="text" wire:model="slug" label="{{ __('Slug') }}" />
            <x-editor wire:model="body" label="{{ __('Content') }}" :config="config('tinymce.config')"
                folder="{{ 'photos/' . now()->format('Y/m') }}" />
            <x-card title="{{ __('SEO') }}" shadow separator>
                <x-input placeholder="{{ __('Title') }}" wire:model="seo_title" hint="{{ __('Max 70 chars') }}" />
                <br>
                <x-textarea label="{{ __('META Description') }}" wire:model="meta_description"
                    hint="{{ __('Max 160 chars') }}" rows="2" inline />
                <br>
                <x-textarea label="{{ __('META Keywords') }}" wire:model="meta_keywords"
                    hint="{{ __('Keywords separated by comma') }}" rows="1" inline />
            </x-card>
            <x-file wire:model="photo" label="{{ __('Featured image') }}"
                hint="{{ __('Click on the image to modify') }}" accept="image/png, image/jpeg">
                <img src="{{ $photo == '' ? '/storage/ask.jpg' : $photo }}" class="h-40" />
            </x-file>
            <x-slot:actions>
                <x-helpers.cancel-btn :lk="route('posts.index')" />
                <x-helpers.save-btn />
            </x-slot:actions>
        </x-form>
    </x-card>
    <x-helpers.progress-bar />
</div>
