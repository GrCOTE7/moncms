<?php
include_once 'test3.php';
?>

<div>
    <x-header title="Project Birthday (Test3)" shadow separator progress-indicator />


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
