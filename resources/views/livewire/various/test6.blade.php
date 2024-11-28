<?php
include_once 'test5.php';
?>

@section('title', __('Test page') . ' 5')
<div class="w-full">
    <p class="text-2xl mb-5">{{ __('Study') }} {{ __('of') }} <b>...</b></p>

    <hr class="mt-5 my-5 border-orange-400 border-2" />

    <div class="w-full text-justify">

        <pre>
{{ print_r($data ?? 'No data ', 1) }}
        </pre>

    </div>
</div>
{{-- <x-icon name="eye-dropper" class="text-gray-500" /> --}}
