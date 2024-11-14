<?php
include_once 'test.php';
?>

<div class="h-[90vh]">
    <a href="/" title="{{ __('Return on site') }}">
        <x-header class="text-lg m-0" title="{{ __('Test page') }}" shadow separator progress-indicator />
    </a>

    <p class="text-2xl mb-5">{{ __('Study') }} {{ __('of') }} app/Http/Tools/Fakers.php-><b>cutSentence()</b></p>

    <div class="w-full text-justify">
        {{ $sentence->complete }}
        <hr class="my-3">
        {{ $sentence->wellCut }}
    </div>
</div>
