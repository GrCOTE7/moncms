<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

use App\Models\{Page, Post};
use Illuminate\Support\Facades\{File, Storage};
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Livewire\Attributes\{Layout, Title};
use Livewire\Volt\Component;
use Mary\Traits\Toast;

new #[Layout('components.layouts.admin')] class extends Component {
	use Toast;

	public int $year;
	public int $month;
	public int $id;
	public string $image;
	public string $displayImage;
	public array $usage;
	public string $fileName;
	public string $imagePath;
	public string $tempPath;
	public int $width;
	public int $height;
	public string $imageScale  = '1';
	public array $selectValues = [['id' => '1', 'name' => '1'], ['id' => '0.95', 'name' => '0.95'], ['id' => '0.9', 'name' => '0.9'], ['id' => '0.85', 'name' => '0.85'], ['id' => '0.8', 'name' => '0.8']];
	public string $group;
	public int $brightness = 0;
	public int $contrast   = 0;
	public int $gamma      = 10;
	public int $red        = 0;
	public int $green      = 0;
	public int $blue       = 0;
	public int $reduce     = 0;
	public int $blur       = 0;
	public int $sharpen    = 0;
	public bool $changed;
	public int $clipW = 0;
	public int $clipH = 0;

	public function mount($year, $month, $id): void
	{
		$this->year  = $year;
		$this->month = $month;
		$this->id    = $id;
		$this->getImage($year, $month, $id);
		$this->usage = $this->findUsage();
		$this->saveImageToTemp(false);
		$this->getImageInfos();
	}

	public function saveImageToTemp($viewToast): void
	{
		$tempDir        = Storage::disk('public')->path('temp');
		$this->tempPath = "{$tempDir}/{$this->fileName}";

		if (!File::exists($tempDir)) {
			File::makeDirectory($tempDir, 0o755, true);
		}

		if (File::exists($this->imagePath)) {
			File::copy($this->imagePath, $this->tempPath);
		}

		if ($viewToast) {
			$this->success(__('Changes validated'));
		}

		$this->image = Storage::disk('public')->url('temp/' . $this->fileName);
	}

	public function restoreImage($cancel): void
	{
		if (File::exists($this->imagePath)) {
			File::copy($this->imagePath, $this->tempPath);
			$this->refreshImageUrl();
			$this->clipW = 0;
			$this->clipH = 0;
			$this->getImageInfos();
			$this->success(__('Image restored'));
		}

		$this->changed = false;

		if ($cancel) {
			$this->info(__('No modification has been made'));
			$this->exit();
		}
	}

	public function updated($property, $value)
	{
		if ('group' === $property) {
			return;
		}

		$manager = new ImageManager(new Driver());
		$image   = $manager->read($this->tempPath);

		switch ($property) {
			case 'imageScale':
				$image->scale(height: $this->height * $value);
				$this->width      = $image->width();
				$this->height     = $image->height();
				$this->imageScale = '1';

				break;
			case 'brightness':
				$image->brightness($value);
				$this->brightness = 0;

				break;
			case 'contrast':
				$image->contrast($value);
				$this->contrast = 0;

				break;
			case 'gamma':
				$image->gamma($value / 10.0);
				$this->gamma = 10;

				break;
			case 'red':
				$image->colorize(red: $value);
				$this->red = 0;

				break;
			case 'green':
				$image->colorize(green: $value);
				$this->green = 0;

				break;
			case 'blue':
				$image->colorize(blue: $value);
				$this->blue = 0;

				break;
			case 'blur':
				$image->blur($value);
				$this->blur = 0;

				break;
			case 'sharpen':
				$image->sharpen($value);
				$this->sharpen = 0;

				break;
			case 'clipW':
				$width  = $this->width - $this->width * $value * 0.01;
				$offset = ($this->width - $width) / 2;
				$image->crop($width, $this->height, $offset);
				$this->width  = $image->width();
				$this->height = $image->height();
				$this->clipW  = 0;

				break;
			case 'clipH':
				$height = $this->height - $this->height * $value * 0.01;
				$offset = ($this->height - $height) / 2;
				$image->crop($this->width, $height, 0, $offset);
				$this->width  = $image->width();
				$this->height = $image->height();
				$this->clipH  = 0;

				break;
			case 'reduce':
				$image->reduceColors(49 - $value);
				$this->reduce = 0;

				break;
			default:
				break;
		}

		$image->save();
		$this->info(__('Image modified ! (Not saved yet)'));
		$this->changed = true;
		$this->refreshImageUrl();
	}

	public function invert(): void
	{
		$manager = new ImageManager(new Driver());
		$image   = $manager->read($this->tempPath);
		$image->invert();
		$image->save();
		$this->info(__('Image modified ! (Not saved yet)'));
		$this->changed = true;
		$this->refreshImageUrl();
	}

	public function getImage($year, $month, $id): void
	{
		$imagesPath         = "photos/{$year}/{$month}";
		$allFiles           = Storage::disk('public')->files($imagesPath);
		$image              = $allFiles[$id];
		$this->imagePath    = Storage::disk('public')->path($image);
		$this->fileName     = basename($this->imagePath);
		$this->image        = Storage::disk('public')->url("temp/{$this->fileName}");
		$this->displayImage = Storage::disk('public')->url($image);
		$this->refreshImageUrl();
	}

	public function keepVersion(): void
	{
		if (File::exists($this->tempPath)) {
			File::copy($this->tempPath, $this->imagePath);
		}
		$this->success(__('Image changes applied successfully'));
		$this->exit();
	}

	public function exit(): void
	{
		if (File::exists($this->tempPath)) {
			File::delete($this->tempPath);
		}

		redirect()->route('images.index');
	}

	public function applyChanges(): void
	{
		if (File::exists($this->tempPath)) {
			File::copy($this->tempPath, $this->imagePath);
		}

		$this->changed = false;

		$this->success(__('Image changes applied successfully'));
	}

	private function getImageInfos(): void
	{
		$manager      = new ImageManager(new Driver());
		$image        = $manager->read($this->tempPath);
		$this->width  = $image->width();
		$this->height = $image->height();
	}

	private function findUsage(): array
	{
		$usage = [];

		$name = $this->year . '/' . str_pad($this->month, 2, '0', STR_PAD_LEFT) . '/' . $this->fileName;

		$posts = Post::select('id', 'title', 'slug')
			->where('image', 'LIKE', "%{$name}%")
			->orWhere('body', 'LIKE', "%{$name}%")
			->get();

		foreach ($posts as $post) {
			$usage[] = [
				'type'  => 'post',
				'id'    => $post->id,
				'title' => $post->title,
				'slug'  => $post->slug,
			];
		}

		$pages = Page::where('body', 'LIKE', "%{$name}%")->get();

		foreach ($pages as $page) {
			$usage[] = [
				'type'  => 'page',
				'id'    => $page->id,
				'title' => $page->title,
				'slug'  => $page->slug,
			];
		}

		return $usage;
	}

	private function refreshImageUrl(): void
	{
		$this->image = Storage::disk('public')->url("temp/{$this->fileName}") . '?' . now()->timestamp;
	}
};
