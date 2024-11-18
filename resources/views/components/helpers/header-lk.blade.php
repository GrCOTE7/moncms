@props(['title', 'dashboardBtn' => true])

<div>
    <a href="{{ route('home') }}"" title="{{ __('Go on site') }}">
        <x-header :title="__($title)" separator progress-indicator>
            @if ($dashboardBtn)
                <x-slot:actions>
                    <x-button icon="s-building-office-2" :label="__('Dashboard')" class="btn-outline lg:hidden"
                        link="{{ route('admin') }}" />
                </x-slot:actions>
            @endif
        </x-header>
    </a>
</div>
