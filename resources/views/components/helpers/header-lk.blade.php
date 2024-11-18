@props(['title', 'dashboardBtn' => true, 'search' => false])

<div>
    <x-header separator progress-indicator>
        <x-slot:title><a href="{{ route('home') }}" title="{{ __('Go to site') }}">{{ $title }}</a></x-slot:title>
        <x-slot:actions>
            @if ($search)
                <x-slot:middle class="!justify-end">
                    <x-input placeholder="{{ __('Search') }}..." wire:model.live.debounce="search" clearable
                        icon="o-magnifying-glass" />
                </x-slot:middle>
            @endif
            @if ($dashboardBtn)
                <x-button icon="s-building-office-2" :label="__('Dashboard')" class="btn-outline lg:hidden"
                    link="{{ route('admin') }}" />
            @endif
        </x-slot:actions>
    </x-header>
</div>
