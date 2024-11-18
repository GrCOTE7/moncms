<?php
include_once 'test1.php';
?>
@section('title', __('Test page').' 1')
<div>
    <x-helpers.header-lk title="{{ __('Test page') }} 1"/>
    
    <p class="text-2xl mb-5">{{ __('Study') }} {{ __('of') }} <b>Envoi de mail</b></p>

    <div class="w-full text-justify">
        Ready.
        <hr>
        <pre>
            {{ print_r($data) }}
        </pre>
    </div>
</div>
