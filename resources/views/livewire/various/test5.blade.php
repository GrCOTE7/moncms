<?php
include_once 'test5.php';
?>

@section('title', __('Test page') . ' 5')
<div class="w-full">
     <x-helpers.header-lk title="{{ trim($__env->yieldContent('title')) }}" forceHeader=true />
    <p class="text-2xl mb-5">{{ __('Study') }} {{ __('of') }} <b>...</b></p>

    <hr class="mt-5 my-5 border-orange-400 border-2" />

    <div class="w-full text-justify">

        <pre>
{{ print_r($data ?? 'No data ', 1) }}
        </pre>

<x-button class="btn-primary" wire:click="confirm">Confirmer</x-button>
    </div>
</div>
{{-- <x-icon name="eye-dropper" class="text-gray-500" /> --}}
