<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

use App\Models\Member;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new class extends Component {
	use WithPagination;

	// public function mount()
	// {
	// }

	// Table headers
	public function headers(): array
	{
		return [
			['key' => 'id', 'label' => '#', 'class' => 'w-1'],
			['key' => 'name', 'label' => 'Name', 'class' => 'w-64'],
			['key' => 'project_id', 'label' => '# Pj', 'class' => 'w-50', 'sortable' => true],
			['key' => 'project_name', 'label' => 'Pj'],
			['key' => 'project_start_date', 'label' => 'Pj Date', 'class' => 'w-50'],
		];
        // 2fix: Align right '# Pj' column
	}

	public function members(): LengthAwarePaginator
	{
		return Member::selectRaw('*')
			->orderBy('name')
			->paginate(2);
	}

	public function with(): array
	{
		return [
			'members' => $this->members(),
			'headers' => $this->headers(),
		];
	}
}; ?>

<div>
  <x-header title="Project Birthday (Test3)" shadow separator progress-indicator />

  <p class="mt-[-15px] mb-3">{{ number_format($members->total(), 0, ',', ' ') }} members</p>

  {{ $members->links() }}
  {{-- {{  dd($members) }} --}}

  <x-card>
    <x-table :headers="$headers" :rows="$members" with-pagination>
    </x-table>
  </x-card>

  <hr class="my-1">
</div>
