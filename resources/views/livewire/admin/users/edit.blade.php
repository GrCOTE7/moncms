<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Attributes\{Layout, Title};
use Livewire\Volt\Component;
use Mary\Traits\Toast;

new #[Layout('components.layouts.admin')] class extends Component {
    use Toast;

    public User $user;
    public string $name = '';
    public string $email = '';
    public string $role = '';
    public bool $valid = false;
    public bool $isStudent;

    public function mount(User $user): void
    {
        $this->user = $user;
        $this->fill($this->user);
    }

    public function save()
    {
        $data = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->user->id)],
            'role' => ['required', Rule::in(['admin', 'redac', 'user'])],
            'valid' => ['required', 'boolean'],
        ]);

        $this->user->update($data);

        $this->success(__('User edited with success.'), redirectTo: '/admin/users/index');
    }

    public function with(): array
    {
        return [
            'roles' => [['name' => __('Administrator'), 'id' => 'admin'], ['name' => __('Redactor'), 'id' => 'redac'], ['name' => __('User'), 'id' => 'user']],
        ];
    }
}; ?>

@section('title', __('Edit an account'))
<div>
    <x-card>
        <x-form wire:submit="save">
            <x-input label="{{ __('Name') }}" wire:model="name" icon="o-user" inline />
            <x-input label="{{ __('E-mail') }}" wire:model="email" icon="o-envelope" inline />
            <br>
            <x-radio label="{{ __('User role') }}" inline label="{{ __('Select a role') }}" :options="$roles"
                wire:model="role" />
            <br>
            <x-toggle label="{{ __('Valid user') }}" inline wire:model="valid" />
            <x-slot:actions>
                <x-helpers.cancel-save-btns :lk="route('users.index')" />
            </x-slot:actions>
        </x-form>
    </x-card>
</div>
