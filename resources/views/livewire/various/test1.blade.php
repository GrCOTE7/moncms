<?php
include_once 'test1.php';
?>

<div>
    <a href="/" title="{{ __('Return on site') }}">
        <x-header class="text-lg m-0" title="{{ __('Test page') }} 1" shadow separator progress-indicator />
    </a>

    <p class="text-2xl mb-5">{{ __('Study') }} {{ __('of') }} <b>Envoi de mail</b>
    </p>

    <div class="w-full text-justify">
        Ready.
        <hr>
        <pre>
            {{ print_r($data) }}
        </pre>
    </div>
</div>
