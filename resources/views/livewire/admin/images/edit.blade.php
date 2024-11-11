<?php
include_once 'edit_image.php';
?>

<div class="flex flex-col h-full lg:flex-row">
    <div class="w-full p-4 lg:w-3/4">
        <x-header title="{{ __('Manage an image') }}" separator progress-indicator>
            <x-slot:actions class="lg:hidden">
                <x-button icon="s-building-office-2" label="{{ __('Dashboard') }}" class="btn-outline"
                    link="{{ route('admin') }}" />
            </x-slot:actions>
        </x-header>
        <x-card>
            <div class="flex items-center justify-between h-full">
                <p>@lang('The url of this image is :') <i>{{ $this->displayImage }}</i></p>
                <x-button label="{!! __('Copy url') !!}" data-url="{{ $this->displayImage }}" onclick="copyUrl(this)"
                    class="btn-sm" />
            </div>
            <br>
            @if (empty($this->usage))
                <x-badge value="{!! __('This image is not used') !!}" class="badge-warning" />
            @else
                @foreach ($this->usage as $use)
                    @if ($use['type'] == 'post')
                        <p>@lang('This image is in the post ') : <b><a href="{{ route('posts.show', $use['slug']) }}" target="_blank">{{ $use['title'] }}</a></b></p>
                    @else
                        <p>@lang('This image is in the page ') :
                            <b><a href="{{ route('pages.show', $use['slug']) }}" target="_blank">{{ $use['title'] }}</a></b>
                        </p>
                    @endif
                @endforeach
            @endif
            <br><br>
            <x-header separator progress-indicator />
            <div class="flex items-center justify-center h-full">
                <img src="{{ $image }}" alt="">
            </div>
            <x-header separator progress-indicator />
        </x-card>
    </div>

    <div class="w-full p-4 lg:w-1/4">
        <p class="mb-2 text-3xl">@lang('Settings')</p>
        <x-accordion wire:model="group" class="mb-4 shadow-md">
            <x-collapse name="group1">
                <x-slot:heading>
                    @lang('Size change')
                </x-slot:heading>
                <x-slot:content>
                    @lang('Height') :
                    <x-badge value="{{ $this->height }}px" class="badge-primary" /><br>
                    @lang('Width') :
                    <x-badge value="{{ $this->width }}px" class="badge-primary" /><br><br>
                    <x-radio inline label="{{ __('Select a rescale value') }}" :options="$selectValues"
                        wire:model="imageScale" wire:change="$refresh" />
                </x-slot:content>
            </x-collapse>
            <x-collapse name="group2">
                <x-slot:heading>
                    @lang('Brightness, contrast and gamma correction')
                </x-slot:heading>
                <x-slot:content>
                    <x-range wire:model.live.debounce="brightness" min="-20" max="20" step="2"
                        label="{{ __('Brightness') }}" class="range-primary" />
                    <x-range wire:model.live.debounce="contrast" min="-20" max="20" step="2"
                        label="{{ __('Contrast') }}" class="range-primary" />
                    <x-range wire:model.live.debounce="gamma" min="5" max="22"
                        label="{{ __('Gamma Correction') }}" class="range-primary" />
                </x-slot:content>
            </x-collapse>
            <x-collapse name="group3">
                <x-slot:heading>
                    @lang('Color correction')
                </x-slot:heading>
                <x-slot:content>
                    <x-range wire:model.live.debounce="red" min="-20" max="20" step="2"
                        label="{{ __('Red') }}" class="range-primary" />
                    <x-range wire:model.live.debounce="green" min="-20" max="20" step="2"
                        label="{{ __('Green') }}" class="range-primary" />
                    <x-range wire:model.live.debounce="blue" min="-20" max="20" step="2"
                        label="{{ __('Blue') }}" class="range-primary" />
                    <x-range wire:model.live.debounce="reduce" min="0" max="48" step="2"
                        label="{{ __('Reduce color') }}" class="range-primary" />
                    <x-button label="{{ __('Invert colors') }}" wire:click="invert" class="mt-2 btn-outline btn-sm" />
                </x-slot:content>
            </x-collapse>
            <x-collapse name="group4">
                <x-slot:heading>
                    @lang('Blur and sharpen')
                </x-slot:heading>
                <x-slot:content>
                    <x-range wire:model.live.debounce="blur" min="0" max="20" step="2"
                        label="{{ __('Blur') }}" class="range-primary" />
                    <x-range wire:model.live.debounce="sharpen" min="0" max="20" step="2"
                        label="{{ __('Sharpen') }}" class="range-primary" />
                </x-slot:content>
            </x-collapse>
            <x-collapse name="group5">
                <x-slot:heading>
                    @lang('Crop')
                </x-slot:heading>
                <x-slot:content>
                    <x-range wire:model.live.debounce="clipW" min="0" max="40" step="2"
                        label="{{ __('Width') }}" class="range-primary" />
                    <x-range wire:model.live.debounce="clipH" min="0" max="40" step="2"
                        label="{{ __('Height') }}" class="range-primary" />
                </x-slot:content>
            </x-collapse>
        </x-accordion>
        @if ($changed)
            <x-button wire:click="restoreImage(false)" class="btn-sm">@lang('Restore image to its original state')
            </x-button><br>
            <x-button wire:click="applyChanges" class="mt-2 btn-sm">@lang('Valid changes')</x-button><br>
            <x-button wire:click="restoreImage(true)" class="mt-2 btn-sm">@lang('Finish and discard this version')</x-button>
        @endif
        <x-button wire:click="keepVersion" class="mt-2 btn-sm">@lang('Finish and keep this version')</x-button><br>
    </div>

    <script>
        function copyUrl(button) {
            const url = button.dataset.url; //+ succinct...
            const textArea = document.createElement('textarea');
            textArea.value = url;
            document.body.appendChild(textArea);
            textArea.select();
            try {
                document.execCommand('copy');
                alert('URL copiée: ' + url);
            } catch (err) {
                console.error('Erreur lors de la copie de l\'URL: ', err);
            }
            document.body.removeChild(textArea);
        }
    </script>
</div>
