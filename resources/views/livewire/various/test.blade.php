<?php
include_once 'test.php';
?>

<div class="h-[90vh]">
    <a href="/" title="{{ __('Return on site') }}">
        <x-header class="text-lg m-0" title="Page de Test" shadow separator progress-indicator />
    </a>

    <p class="text-xl mb-5">Ready</p>

    <div class="w-full text-justify">
        {{ $sentence->complete }}
        <hr class="my-3">
        {{ $sentence->wellCut }}
    </div>
</div>
