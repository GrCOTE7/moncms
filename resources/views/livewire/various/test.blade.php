<?php
include_once 'test.php';
?>
@section('title', __('Test page'))
<div>
    <p class="text-2xl mb-5">{{ __('Study') }} {{ __('of') }} app/Http/Tools/Fakers.php-><b>cutSentence()</b></p>

    <div class="w-full text-justify">
        {{ $sentence->complete }}
        <hr class="my-3">
        {{ $sentence->wellCut }}
    </div>
</div>
