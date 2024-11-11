<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new class extends Component {
	use WithPagination;

	public array $sortBy = ['column' => 'username', 'direction' => 'asc'];
	public int $k        = 0;

	public function mount(Request $request)
	{
		$this->abc = 789;
		// $this->sort      = $request->get('sort', 'name');
		// $this->direction = $request->get('direction', 'asc');
	}

	// Table headers
	public function headers(): array
	{
		// echo $this->abc;

		return [
			// , 'sortable' => false],
			['key' => 'id', 'label' => '#', 'class' => 'w-1 text-right'],
			['key' => 'username', 'label' => 'Username', 'class' => 'w-64'],
			['key' => 'firstname', 'label' => 'First Name', 'class' => 'w-64'],
			['key' => 'name', 'label' => 'Name', 'class' => 'w-64'],
			['key' => 'project_id', 'label' => '# Pj', 'class' => 'w-1 text-right'],
			['key' => 'project_name', 'label' => 'Pj name', 'class' => 'capitalize'],
			['key' => 'project_birthday', 'label' => 'Pj Birthday', 'class' => 'w-50'],
		];
	}

	public function members(): LengthAwarePaginator
	{
		// 0: WithAggregate
		// 1: Méthode simple
		// 2: Comme vidéo
		$k = 1;

		$this->k = $k;

		if (0 === $k) {
			// Avec withAggregate: Sous-requêtes... : 20-25 ms
			return Member::withAggregate('project', 'name')
				->withAggregate('project', 'start_at')
				// ->whereIn('members.id', [844, 462, 553])
				->orderBy(...array_values($this->sortBy))
				->paginate(perPage: 100);
		}
		if (1 === $k) {
			// Méthode simple mais efficace pour les projets liés : 60-80ms
			return Member::selectRaw('members.*, projects.name as project_name, SUBSTR(projects.start_at, 6, 2) || "-" || SUBSTR(projects.start_at, 9, 2) as project_birthday')
				->join('projects', 'members.project_id', '=', 'projects.id')
			// ->whereIn('members.id', [844, 462, 553])
				->orderBy(...array_values($this->sortBy))
				->paginate(100);
		}

		//   ok k 3.

		return Member::query()
			->with('project')
			->selectRaw('members.*')
			->paginate(2);
	}

	public function with(): array
	{
		return [
			'members' => $this->members(),
			'headers' => $this->headers(),
			'k'       => $this->k,
		];
	}
};