<?php
include_once 'test3.php';
?>

<div>
    <a href="/" title="{{ __('Return on site') }}">
        <x-header class="text-lg m-0" title="{{ __('Test page') }} 3" shadow separator progress-indicator />
    </a>


    @if($k<2)
        <p class="mt-[-15px] mb-3">{{ number_format($members->total(), 0, ',', ' ') }} members - Case #{{ $k }}</p>


        {{ $members->links() }}
        {{-- {{  dd($members) }} --}}

        <x-card>
            <x-table :headers="$headers" :rows="$members" :sort-by="$sortBy" with-pagination>
            </x-table>
        </x-card>
    @endif
    Oki<hr>
    {{  $members[0]->project->name }}
    <hr class="my-1">
</div>
