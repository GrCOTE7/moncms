<?php
include_once 'test2.php';
?>

<div>
    <a href="/" title="{{ __('Return on site') }}">
        <x-header class="text-lg m-0" title="{{ __('Test page') }} 2" shadow separator progress-indicator />
    </a>

    <p class="mt-[-15px] mb-3">{{ number_format($members->total(), 0, ',', ' ') }} résults</p>

    {{ $members->links() }}
    {{-- {{  dd($members) }} --}}

    <x-card>
        <x-table :headers="$headers" :rows="$members" with-pagination>
        </x-table>
    </x-card>

    <hr class="my-1">
</div>
