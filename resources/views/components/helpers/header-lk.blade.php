@props(['title', 'lk' => 'No link', 'dashboardBtn' => true])

<div>
    - HELPER SS BTN
    <a href="/" title="{{ __('Go on site') }}">
        <x-header title="{{ __('Settings1 ') }}" separator progress-indicator />
    </a>


    <x-header :title="__($title).'777'" separator progress-indicator>
        <x-slot:actions>
            @if ($dashboardBtn)
                <x-button icon="s-building-office-2" :label="__('Dashboard')" class="btn-outline lg:hidden" :link="$lk" />
            @endif
        </x-slot:actions>
    </x-header>

    <x-header title="{{ __('Settings ORI') }}" separator progress-indicator>
        <x-slot:actions>
            <x-button icon="s-building-office-2" label="{{ __('Dashboard') }}" class="btn-outline lg:hidden"
                link="{{ route('admin') }}" />
        </x-slot:actions>
    </x-header>
</div>
