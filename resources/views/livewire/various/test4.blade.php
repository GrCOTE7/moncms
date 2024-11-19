<?php
include_once 'test4.php';
?>

@section('title', __('Test page') . ' 4')
<div>
    <x-helpers.header-lk title="{{ __('Test page') }} 4" />
    <p class="text-2xl mb-5">{{ __('Study') }} {{ __('of') }} <b>Component Header</b></p>

    <hr class="mt-5 my-5 border-orange-400 border-2" />

    V normale (Sans btn Dashboard) :
    <hr class="mb-5">
    <a href="/" title="{{ __('Go to site') }}">
        <x-header title="{{ __('Settings') }}" separator progress-indicator />
    </a>

    V normale (Avec btn Dashboard) :
    <hr class="mb-5">
    <x-header separator progress-indicator>
        <x-slot:title>
            <a href="/" title="{{ __('Go to site') }}">
                {{ __('Settingso') }}
            </a>
        </x-slot:title>
        <x-slot:actions>
            <x-button icon="s-building-office-2" label="{{ __('Dashboard') }}" class="btn-outline lg:hidden"
                link="{{ route('admin') }}" />
        </x-slot:actions>
    </x-header>

    <hr class="mt-5 my-5 border-orange-400 border-2">

    <x-helpers.header-lk :title="__('Settings1')" :dashboardBtn="false" />

    <x-helpers.header-lk :title="__('Settings2')" />

    <div class="w-full text-justify">

        Ready.

    </div>
</div>
{{-- <x-icon name="eye-dropper" class="text-gray-500" /> --}}
