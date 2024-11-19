<?php
include_once 'test4.php';
?>

<div>
    <a href="/" title="{{ __('Back to site') }}"><x-header class="text-lg m-0" title="{{ __('Test page') }} 4" shadow
            separator progress-indicator /></a>
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
        <x-heroicon-o-cog class="h-6 w-6 text-gray-500" />

<x-icon name="c-cog-6-tooth" />
    </div>
</div>
{{-- <x-icon name="eye-dropper" class="text-gray-500" /> --}}
