<?php
include_once 'index_posts.php';
?>

<div>

    <x-header separator progress-indicator>
        <x-slot:title><a href="{{ route('home') }}" title="{{ __('Go to site') }}">{{ __('Posts') }}</a></x-slot:title>
        <x-slot:actions>
            <x-input placeholder="{{ __('Search...') }}" wire:model.live.debounce="search" clearable
                icon="o-magnifying-glass" />
            <x-button label="{{ __('Add a post') }}" class="btn-outline lg:hidden"
                link="{{ route('posts.create') }}" />
            <x-button icon="s-building-office-2" label="{{ __('Dashboard') }}" class="btn-outline lg:hidden"
                link="{{ route('admin') }}" />
        </x-slot:actions>
    </x-header>

    <x-collapse>
        <x-slot:heading>
            @lang(__('Filters'))
        </x-slot:heading>
        <x-slot:content>
            <x-select label="{{ __('Category') }}" :options="$categories" placeholder="{{ __('Select a category') }}"
                option-label="title" wire:model="category_id" wire:change="$refresh" />
        </x-slot:content>
    </x-collapse>

    <br>

    @if ($posts->count() > 0)
        <x-card>
            <x-table striped :headers="$headers" :rows="$posts" :sort-by="$sortBy" link="/admin/posts/{slug}/edit"
                with-pagination>
                @scope('header_comments_count', $header)
                    {{ $header['label'] }}
                    <x-icon name="c-chat-bubble-left" />
                @endscope

                @scope('cell_user.name', $post)
                    {{ $post->user->name }}
                @endscope
                @scope('cell_category.title', $post)
                    {{ $post->category->title }}
                @endscope
                @scope('cell_comments_count', $post)
                    @if ($post->comments_count > 0)
                        <x-badge value="{{ $post->comments_count }}" class="badge-primary" />
                    @endif
                @endscope
                @scope('cell_active', $post)
                    @if ($post->active)
                        <x-icon name="o-check-circle" />
                    @endif
                @endscope
                @scope('cell_date', $post)
                    @lang('Created') {{ $post->created_at->diffForHumans() }}
                    @if ($post->updated_at != $post->created_at)
                        <br>
                        @lang('Updated') {{ $post->updated_at->diffForHumans() }}
                    @endif
                @endscope

                @scope('actions', $post)
                    <div class="flex">
                        <x-popover>
                            <x-slot:trigger>
                                <x-button icon="o-finger-print" wire:click="clonePost({{ $post->id }})" spinner
                                    class="btn-ghost btn-sm" />
                            </x-slot:trigger>
                            <x-slot:content class="pop-small">
                                @lang('Clone')
                            </x-slot:content>
                        </x-popover>
                        <x-popover>
                            <x-slot:trigger>
                                <x-button icon="o-trash" wire:click="deletePost({{ $post->id }})"
                                    wire:confirm="{{ __('Are you sure to delete this post?') }}" spinner
                                    class="text-red-500 btn-ghost btn-sm" />
                            </x-slot:trigger>
                            <x-slot:content class="pop-small">
                                @lang('Delete')
                            </x-slot:content>
                        </x-popover>
                    </div>
                @endscope
            </x-table>
        </x-card>
    @endif
</div>
