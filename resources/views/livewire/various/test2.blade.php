<?php
include_once 'test2.php';
?>

<div>
    <x-header title="Members (Test 2)" shadow separator progress-indicator />

    <p class="mt-[-15px] mb-3">{{ number_format($members->total(), 0, ',', ' ') }} résults</p>

    {{ $members->links() }}
    {{-- {{  dd($members) }} --}}

    <x-card>
        <x-table :headers="$headers" :rows="$members" with-pagination>
        </x-table>
    </x-card>

    <hr class="my-1">
</div>
