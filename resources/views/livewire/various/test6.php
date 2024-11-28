<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

ini_set('memory_limit', '8G'); // Augmenter la limite de mémoire à 256 Mo

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use App\Models\{User};
use Faker\Factory as Faker;
use Illuminate\Support\{Benchmark, Str};
use Livewire\Attributes\{Layout};
use Livewire\Volt\Component;
use Livewire\WithPagination;

new
#[Layout('components.layouts.test')]
class extends Component {
	use WithPagination;

	public $data;
	private $sentence;
	private $slug;

	public function mount() {
		// $user = (User::whereId(1))->get()->dd();
		// $user = User::find(2);

		// Log::info(User::where('name', 'admin')->toSql());

		// $this->data = $this->getUser($user);

		// echo Benchmark::measure(fn () => Order::all())

		// Log::info('Time', [
		// 	'Time getUser()' => Benchmark::measure(fn () => $this->getUser($user)),
		// ]);

		$nb                                     = 15;
		$this->data['Same count / Total count'] = '';
		for ($i = 0; $i < $nb; $i++) {
			// Log::info("Iteration: {$i}, Memory Usage: " . nf(memory_get_usage()/1024**2).' Mb');
			$this->sentence = $this->getSentence();

			$slug1 = $this->testStrSlugFct();
            $slug2 = $this->testStrSlugFacade();

			Log::info('Time', [
				'Time StrSlugFct()' => Benchmark::measure(fn () => $this->testStrSlugFct()),
				'Time StrSlugFacade()' => Benchmark::measure(fn () => $this->testStrSlugFacade()),
			]);

			// Replace (str_diff($slug1, $slug2)) with a proper comparison method
			if ($slug1 !== $slug2) {
				Log::info('message', [
					$this->str_diff_chars($slug1, $slug2),
					"Slug 1: {$slug1}",
					"Slug 2: {$slug2}",
				]);

				$this->data[] = [
					$this->sentence,
					(($slug1 === $slug2) ? 'Identiques' : 'Différents'),
					$this->str_diff_chars($slug1, $slug2),
					[$slug1, $slug2],
				];
			}
		}

		Log::info("Iteration: {$i}, Memory Usage: " . nf(memory_get_usage() / 1024 ** 2) . ' Mb');

		$this->data['Same count / Total count'] = $nb - (count($this->data) - 1) . ' /' . $nb;
	}

	public function getUser(User $user) {
		// composer require barryvdh/laravel-ide-helper
		// php artisan ide-helper:models
		// php artisan ide-helper:models -M
		// php artisan ide-helper:generate

		Log::withContext(['getUser() In' => $user]);
		Log::withContext(['getUser() Out' => [$user->name, $user->email]]);

		return [$user->name, $user->email];
		// dd($post);
	}

	public function with(): array {
		return [];
	}

	public function str_slug($sentence, $separator = '-') {
		// Convertir en minuscules
		// Supprimer les accents même des lettre en majuscules
		$transliteratedString = transliterator_transliterate('NFD; [:Nonspacing Mark:] Remove; NFC', $sentence);
		$string_s             = strtolower($transliteratedString);

		// Remplacer les caractères non alphanumériques par des séparateurs et retirer les apostrophes

		// $string = str_replace(
		// 	["'", 'à', 'â', 'ù', 'î', 'ï', 'ç', 'é', 'ê', 'è', 'ë', 'ô', 'û', '«', '»'],
		// 	['', 'a', 'a', 'u', 'i', 'i', 'c', 'e', 'e', 'e', 'e', 'o0', 'u', '', ''],
		// 	$string_s
		// );

		$string = str_replace(
			["'", 'à', 'â', 'ù', 'î', 'ï', 'ç', 'é', 'ê', 'è', 'ë', 'ô', 'û'],
			['', 'a', 'a', 'u', 'i', 'i', 'c', 'e', 'e', 'e', 'e', 'o0', 'u'],
			$string_s
		);

		$string = str_replace(["'", '?', '«', '»', '°'], '', $string);

		// Remplacer les caractères non alphanumériques par des séparateurs
		$string = preg_replace('/[^a-z0-9\»]+/', $separator, $string);

		// Supprimer les séparateurs en début et fin de chaîne
		return trim($string, $separator);
	}

	public function str_diff_chars($str1, $str2) {
		$length      = max(strlen($str1), strlen($str2));
		$differences = [];

		for ($i = 0; $i < $length; $i++) {
			$char1 = $str1[$i] ?? '';
			$char2 = $str2[$i] ?? '';

			if ($char1 !== $char2) {
				$differences[] = [
					'position' => $i,
					'str1'     => $char1,
					'str2'     => $char2,
				];
			}
		}

		return $differences[0] ?? 'None';
	}

	/**
	 * Test de la fonction de slugification str_slug.
	 *
	 * @see https://github.com/laravel/framework/blob/5.8/src/Illuminate/Support/Str.php#L434
	 * @see https://github.com/illuminate/support/blob/master/Str.php#L434
	 */
	private function testStrSlugFct() {
		return $this->str_slug($this->sentence);
		// Log::info($slug);
	}

	private function testStrSlugFacade() {
		return Str::slug($this->sentence);
		// Log::info($slug);
	}

	private function getSentence() {
		$faker = Faker::create('fr_FR');

		return $faker->realText(200, 3);
		// return 'Salut»toi';
	}
};

function nf($n, $dec = 0) {
	return number_format($n, $dec, ',', ' ');
}
