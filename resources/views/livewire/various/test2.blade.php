<?php
include_once 'test2.php';
?>

<div>
    <a href="/" title="{{ __('Return on site') }}"><x-header class="text-lg m-0" title="{{ __('Test page') }} 2" shadow separator progress-indicator /></a>
    <p class="text-2xl mb-5">{{ __('Study') }} {{ __('of') }} <b>Lien mailto</b></p>

    <div class="w-full text-justify">

        <a href="mailto:{{ env('MAIL_FROM_ADDRESS') }}">{{ env('MAIL_FROM_ADDRESS') }}</a>

        <br>

        <a href="mailto:example@example.com">example@example.com</a>



        
    </div>
</div>
