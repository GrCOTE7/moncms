<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;

new #[Layout('components.layouts.admin')] class extends Component {
	use Toast;
	use WithPagination;

	public string $search = '';
	public array $sortBy  = ['column' => 'name', 'direction' => 'asc'];
	public string $role   = 'all';
	public array $roles   = [];

    public function mount(): void
    {
        View::share('noHeader', true);
    }

	public function deleteUser(User $user): void
	{
		$user->delete();
		$this->success($user->name . ' ' . __('deleted'));
	}

	// Définir les en-têtes de table.
	public function headers(): array
	{
		$headers = [
			['key' => 'name',  'label' => __('Name')],
			['key' => 'email', 'label' => 'E-mail'],
			['key' => 'role',  'label' => __('Role')],
			['key' => 'valid', 'label' => __('Valid')],
		];

		if ('user' !== $this->role) {
			$headers = array_merge($headers, [
				['key' => 'posts_count', 'label' => __('Posts')],
			]);
		}

		return array_merge($headers, [
			['key' => 'comments_count', 'label' => __('Comments')],
			['key' => 'created_at',     'label' => __('Registration')],
		]);
	}

	public function users(): LengthAwarePaginator
	{
		$query = User::query()
			->when($this->search, fn ($q) => $q
				->where('name', 'like', "%{$this->search}%")
				->orWhere('email', 'like', "%{$this->search}%"))
			->when('all' !== $this->role, fn ($q) => $q
				->where('role', $this->role))
			->withCount('posts', 'comments')
			->orderBy(...array_values($this->sortBy));

		$users = $query->paginate(10);

		$userCountsByRole = User::selectRaw('role, count(*) as total')
			->groupBy('role')
			->pluck('total', 'role');

		$totalUsers = $userCountsByRole->sum();

		$this->roles = collect([
			'all'   => __('All') . " ({$totalUsers})",
			'admin' => __('Administrators'),
			'redac' => __('Redactors'),
			'user'  => __('Users'),
		])
			->map(function ($roleName, $roleId) use ($userCountsByRole) {
				$count = $userCountsByRole->get($roleId, 0);

				return [
					'name' => 'all' === $roleId ? $roleName : "{$roleName} ({$count})",
					'id'   => $roleId,
				];
			})
			->values()
			->all();

		return $users;
	}

	public function with(): array
	{
		return [
			'users'   => $this->users(),
			'headers' => $this->headers(),
		];
	}
};