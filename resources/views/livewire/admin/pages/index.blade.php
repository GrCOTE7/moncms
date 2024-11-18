<?php

use App\Models\Page;
use Livewire\Attributes\{Layout, Title};
use Livewire\Volt\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;

new #[Layout('components.layouts.admin')] class extends Component {
    use Toast, WithPagination;

    public array $sortBy = ['column' => 'title', 'direction' => 'asc'];

    public function headers(): array
    {
        return [['key' => 'title', 'label' => __('Title')], ['key' => 'slug', 'label' => 'Slug'], ['key' => 'active', 'label' => __('Published')]];
    }

    public function deletePage(Page $page): void
    {
        $page->delete();
        $this->success(__('Page deleted'));
    }

    public function with(): array
    {
        return [
            'pages' => Page::select('id', 'title', 'slug', 'active')
                ->orderBy($this->sortBy['column'], $this->sortBy['direction'])
                ->get(),
            'headers' => $this->headers(),
        ];
    }
}; ?>
@section('title', __('Pages'))
<div>
    <x-header separator progress-indicator>
        <x-slot:title>
            <a href="{{ route('home') }}" title="{{ __('Go to site') }}">{{ __('Pages') }}</a>
        </x-slot:title>
        <x-slot:actions>
            <x-button icon="c-document-plus" label="{{ __('Add a page') }}" class="btn-outline lg:hidden"
                link="{{ route('pages.create') }}" />
            <x-button icon="s-building-office-2" label="{{ __('Dashboard') }}" class="btn-outline lg:hidden"
                link="{{ route('admin') }}" />
        </x-slot:actions>
    </x-header>

    <x-card>
        <x-table striped :headers="$headers" :rows="$pages" :sort-by="$sortBy" link="/admin/pages/{slug}/edit">
            @scope('cell_active', $page)
                @if ($page->active)
                    <x-icon name="o-check-circle" />
                @endif
            @endscope
            @scope('actions', $page)
                <x-popover>
                    <x-slot:trigger>
                        <x-button icon="o-trash" wire:click="deletePage({{ $page->id }})"
                            wire:confirm="{{ __('Are you sure to delete this page?') }}" spinner
                            class="text-red-500 btn-ghost btn-sm" />
                    </x-slot:trigger>
                    <x-slot:content class="pop-small">
                        @lang('Delete')
                    </x-slot:content>
                </x-popover>
            @endscope
        </x-table>
    </x-card>
</div>
