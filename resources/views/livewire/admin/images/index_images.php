<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\{Layout, Title};
use Livewire\Volt\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;

new #[Title('Images')] #[Layout('components.layouts.admin')]
class extends Component {
	use Toast;
	use WithPagination;

	public array $allImages = [];
	public Collection $years;
	public Collection $months;
	public $selectedYear;
	public $selectedMonth;
	public int $perPage = 10;
	public int $page    = 1;
	public $myDirectory;

	// Définir les en-têtes de table.
	public function headers(): array
	{
		return [
			['key' => 'image', 'label' => 'Image'], // Colonne ne correspondant pas à un champs de la BdD
			['key' => 'path', 'label' => __('Path') . ' (/photos/)'],
			['key' => 'actions', 'label' => 'Actions', 'class' => 'bg-red-500/10 text-center'], // 3 colonnes groupées
		];
	}

	public function mount(): void
	{
		$this->years  = $this->getYears();
		$this->months = $this->getMonths($this->selectedYear);
		$this->getImages();
	}

	public function updating($property, $value): void
	{
		if ('selectedYear' == $property) {
			$this->months = $this->getMonths($value);
		}
	}

	public function getImages(): LengthAwarePaginator
	{
		$imagesPath = "photos/{$this->selectedYear}/{$this->selectedMonth}";
		$allFiles   = Storage::disk('public')->files($imagesPath);

		$this->allImages = collect($allFiles)
			->map(function ($file) {
				return [
					'path' => (strlen($file) > 30) ? substr($file, 7, 13) . ' ... ' . substr($file, -9) : substr($file, 7, 23),
					// 'path' => $file,
					'url' => Storage::disk('public')->url($file),
				];
			})
			->toArray();

		$this->page = LengthAwarePaginator::resolveCurrentPage('page');
		$total      = count($this->allImages);
		$images     = array_slice($this->allImages, ($this->page - 1) * $this->perPage, $this->perPage, true);

		return new LengthAwarePaginator($images, $total, $this->perPage, $this->page, [
			'path'     => LengthAwarePaginator::resolveCurrentPath(),
			'pageName' => 'page',
		]);
	}

	public function deleteImage($index): void
	{
		$url = $this->allImages[$index]['url'];

		// Trouver la position de '/storage'
		$pos = strpos($url, '/storage');
		// Extraire la partie de l'URL après '/storage'
		$path = substr($url, $pos + strlen('/storage'));
		// dd($index, $url, $relativePath);

		Storage::disk('public')->delete($path);

		$this->success(__('Image deleted with success.'));

		// $this->getImages();
		$this->deleteDirectoryIfEmpty();
	}

	public function deleteDirectoryIfEmpty()
	{
		$directory = "photos/{$this->selectedYear}/{$this->selectedMonth}";
		$files     = Storage::disk('public')->files($directory);

		if (0 == count($files)) {
			Storage::disk('public')->deleteDirectory($directory);
			$this->success(__('Image and empty directory deleted with success.'));
			redirect()->route('images.index');
		} else {
			// $this->error(__('Directory is not empty.'));
			$this->success(__('Image deleted with success.'));
			$this->getImages();
		}
	}

	public function with(): array
	{
		return [
			'headers' => $this->headers(),
			'images'  => $this->getImages(),
		];
	}

	private function getYears(): Collection
	{
		return $this->getDirectories('photos', function ($years) {
			$this->selectedYear = $years->first()['id'] ?? null;

			return $years;
		});
	}

	private function getMonths($year): Collection
	{
		return $this->getDirectories("photos/{$year}", function ($months) {
			$this->selectedMonth = $months->first()['id'] ?? null;
			// À activer avec l'exemple de débogage à dé-commenter aussi (en fin de ce code)
			// $this->selectedMonth = '06'; //2ar '07' par défaut
			$this->getImages();

			return $months;
		});
	}

	private function getDirectories(string $basePath, Closure $callback): Collection
	{
		$directories = Storage::disk('public')->directories($basePath);

		$items = collect($directories)->map(function ($path) {
			$name = basename($path);

			return ['id' => $name, 'name' => $name];
		})->sortByDesc('id');

		return $callback($items);
	}
};