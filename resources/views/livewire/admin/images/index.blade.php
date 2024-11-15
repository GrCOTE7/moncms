<?php
include_once 'index_images.php';
?>

<div>
    <x-header title="{{ __('Images') }}" separator progress-indicator>
        <x-slot:actions class="lg:hidden">
            <x-button icon="s-building-office-2" label="{{ __('Dashboard') }}" class="btn-outline"
                link="{{ route('admin') }}" />
        </x-slot:actions>
    </x-header>

    <x-card title="{!! __('Select year and month') !!}" class="shadow-md">
        <x-select label="{{ __('Year') }}" :options="$years" wire:model="selectedYear" wire:change="$refresh" />
        <br>
        <x-select label="{{ __('Month') }}" :options="$months" wire:model="selectedMonth" wire:change="$refresh" />
    </x-card>

    <x-card>
        <x-table striped :headers="$headers" :rows="$images" class="border-2 border-red-500/10" with-pagination>

            @scope('cell_image', $image)
                <div class="w-20 border-white border-[3px]">
                    <a href="{{ $image['url'] }}" target="_blank">
                        <img src="{{ $image['url'] }}" alt="" title="{{ __('Click here to see bigger!') }}">
                    </a>
                    {{-- {{ dd($image) }} --}}
                </div>
            @endscope

            @scope('cell_actions', $image, $selectedYear, $selectedMonth, $perPage, $page, $loop)
                <div class="flex flex-nowrap justify-center text-center gap-2 h-12">
                    <x-popover>

                        <x-slot:trigger>
                            <x-button icon="s-briefcase" data-url="{{ $image['url'] }}" onClick="copyUrl(this)"
                                class="text-blue-500 btn-ghost btn-sm" spinner />
                        </x-slot:trigger>
                        <x-slot:content class="pop-small">
                            @lang('Copy url')
                        </x-slot:content>

                    </x-popover>
                    <x-popover>

                        <x-slot:trigger>
                            <x-button icon="c-wrench"
                                link="{{ route('images.edit', ['year' => $selectedYear, 'month' => $selectedMonth, 'id' => $loop->index + ($page - 1) * $perPage]) }}"
                                class="text-blue-500 btn-ghost btn-sm" spinner />
                        </x-slot:trigger>
                        <x-slot:content class="pop-small">
                            @lang('Manage image')
                        </x-slot:content>

                    </x-popover>
                    <x-popover class="border-white border-2">

                        <x-slot:trigger>
                            <x-button icon="o-trash" wire:click="deleteImage({{ $loop->index }})"
                                wire:confirm="{{ __('Are you sure to delete this image?') }}" spinner
                                class="text-red-500 btn-ghost btn-sm" />
                        </x-slot:trigger>
                        <x-slot:content class="pop-small">
                            @lang('Delete image')
                        </x-slot:content>

                    </x-popover>
                </div>
            @endscope
        </x-table>

        <x-header class="my-3 mb-0" separator progress-indicator />

        {{--
        <h3 class="text-xl font-bold">Exemple de débogage rapide :</h3>
        <pre>
            @php
                $imagesPath = "photos/{$this->selectedYear}/{$this->selectedMonth}";
                $allFiles = Storage::disk('public')->files($imagesPath);
                echo 'Dossier demandé : ' . $imagesPath . '<br>';
                // var_dump($allFiles);
                print_r($allFiles);
                echo '<br><hr><br>';

                // Exemple de l'image 2024/07 :
                $path = '/photos/2024/07/j6pMm9U3u2VbmaHYePcDfXzeHC3hIn8fvjH7nlzo.jpg';
                echo 'La photo : <b>photos/2024/07/j6pMm9U3u2VbmaHYePcDfXzeHC3hIn8fvjH7nlzo.jpg</b><br>
                existe t\'elle dans 2024/07 ? <b>' . (Storage::disk('public')->exists($path) ? 'Oui' : 'Non').' !</b>';
                // Attention: Décommenter ci-dessous effacera réellement l'image...Conserver la copie pour une restauration facile
                // Storage::disk('public')->delete($path);
            @endphp
        </pre>
        --}}
    </x-card>

    <script>
        function copyUrl(button) {
            const url = button.getAttribute('data-url');
            const textArea = document.createElement('textarea');
            textArea.value = url;
            document.body.appendChild(textArea);
            textArea.select();
            try {
                document.execCommand('copy');
                alert('URL copiée : ' + url);
            } catch (err) {
                console.error('Erreur lors de la copie de l\'URL: ', err);
            }
            document.body.removeChild(textArea);
        }
    </script>

</div>
