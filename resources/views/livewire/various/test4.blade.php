<?php
include_once 'test4.php';
?>

<div>
    <a href="/" title="{{ __('Return on site') }}"><x-header class="text-lg m-0" title="{{ __('Test page') }} 4"
            shadow separator progress-indicator /></a>
    <p class="text-2xl mb-5">{{ __('Study') }} {{ __('of') }} <b>Component Header</b></p>
    <hr class="mt-5 my-5 border-orange-400 border-2" />


    V normale (Sans btn Dashboard) :
    <hr class="mb-5">
    <a href="/" title="{{ __('Go on site') }}">
        <x-header title="{{ __('Settings') }}" separator progress-indicator />
    </a>

    V normale (Avec btn Dashboard) :
    <hr class="mb-5">
    <a href="/" title="{{ __('Go on site') }}">
        <x-header title="{{ __('Settings') }}" separator progress-indicator>
            <a href="/" title="{{ __('Go on site') }}">
                {{ __('Settings ORI') }}
            </a>
            <x-slot:actions>
                <x-button icon="s-building-office-2" label="{{ __('Dashboard') }}" class="btn-outline lg:hidden"
                    link="{{ route('admin') }}" />
            </x-slot:actions>
        </x-header>
    </a>

    <hr class="mt-5 my-5 border-orange-400 border-2">

    <x-helpers.header-lk :title="__('Settings1')" :dashboardBtn="false" />

    <x-helpers.header-lk :title="__('Settings2')"/>

    <div class="w-full text-justify">

        Ready.

    </div>
</div>
