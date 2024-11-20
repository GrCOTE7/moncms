@props([
    'title' => '',
    'search' => false,
    'dashboardBtn' => true,
    'addBtn' => null,
    'noHeader' => false,
    'forceHeader' => false,
])

@if (!$noHeader || $forceHeader)
    <div>
        <x-header separator progress-indicator>
            <x-slot:title><a href="/"
                    title="{{ __('Go to site') }}">{{ $title }}</a></x-slot:title>
            <x-slot:actions>
                @if ($search)
                <x-slot:middle class="!justify-end">
                    <x-input placeholder="{{ __('Search') }}..." wire:model.live.debounce="search" clearable
                        icon="o-magnifying-glass" />
                </x-slot:middle>
            @endif
                @if($addBtn)
                <x-button icon="c-document-plus" label="{{ $addBtn['label'] }}" class="btn-outline lg:hidden"
                link="{{ $addBtn['link'] }}" />
                @endif

                @if ($dashboardBtn)
                    <x-button icon="s-building-office-2" :label="__('Dashboard')" class="btn-outline lg:hidden"
                        link="{{ route('admin') }}" />
                @endif
            </x-slot:actions>
        </x-header>
    </div>
@endif
