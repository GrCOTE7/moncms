<?php
include_once 'index_users.php';
?>

<div>
    <x-header separator progress-indicator>
        <x-slot:title>
            <a href="/admin/dashboard" title="{{ __('Back to Dashboard') }}">
                {{ __('Users') }}
            </a>
        </x-slot:title>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="{{ __('Search') }}..." wire:model.live.debounce="search" clearable
                icon="o-magnifying-glass" />
        </x-slot:middle>
    </x-header>


    <x-radio inline :options="$roles" wire:model="role" wire:change="$refresh" />
    <br>

    <x-card>

        @if (count($users))

            <x-table striped :headers="$headers" :rows="$users" :sort-by="$sortBy" link="/admin/users/{id}/edit"
                with-pagination>
                @scope('cell_name', $user)
                    <x-avatar :image="Gravatar::get($user->email)">
                        <x-slot:title>
                            {{ $user->name }}
                        </x-slot:title>
                    </x-avatar>
                @endscope
                @scope('cell_valid', $user)
                    @if ($user->valid)
                        <x-icon name="o-check-circle" />
                    @endif
                @endscope
                @scope('cell_role', $user)
                    @if ($user->role === 'admin')
                        <x-badge value="{{ __('Administrator') }}" class="badge-error" />
                    @elseif($user->role === 'redac')
                        <x-badge value="{{ __('Redactor') }}" class="badge-warning" />
                    @elseif($user->role === 'user')
                        {{ __('User') }}
                    @endif
                @endscope
                @scope('cell_posts_count', $user)
                    @if ($user->posts_count > 0)
                        <x-badge value="{{ $user->posts_count }}" class="badge-primary" />
                    @endif
                @endscope
                @scope('cell_comments_count', $user)
                    @if ($user->comments_count > 0)
                        <x-badge value="{{ $user->comments_count }}" class="badge-success" />
                    @endif
                @endscope
                @scope('cell_created_at', $user)
                    {{ $user->created_at->isoFormat('LL') }}
                @endscope
                @scope('actions', $user)
                    <div class="flex">
                        <x-popover>
                            <x-slot:trigger>
                                <x-button icon="o-envelope" link="mailto:{{ $user->email }}" no-wire-navigate spinner
                                    class="text-blue-500 btn-ghost btn-sm" />
                            </x-slot:trigger>
                            <x-slot:content class="pop-small">
                                @lang('Send an email')
                            </x-slot:content>
                        </x-popover>
                        <x-popover>
                            <x-slot:trigger>
                                <x-button icon="o-trash" wire:click="deleteUser({{ $user->id }})"
                                    wire:confirm="{{ __('Are you sure to delete this user?') }}"
                                    confirm-text="Are you sure?" spinner class="text-red-500 btn-ghost btn-sm" />
                            </x-slot:trigger>
                            <x-slot:content class="pop-small">
                                @lang('Delete')
                            </x-slot:content>
                        </x-popover>
                    </div>
                @endscope
            </x-table>
        @else
            <p>@lang('No users with these criteria').</p>
        @endif

    </x-card>
</div>
