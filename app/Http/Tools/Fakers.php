<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

namespace App\Http\Tools;

use Faker\Factory as FakerBase;

class Fakers {
	/**
	 * Generates a fake sentence (a paragraph with 3 sentences)
	 * which is cut at a hyphen (., ;, !, ...) which is the closest
	 * to the given length.
	 *
	 * @param int $length The length of the sentence to generate.
	 * @return object Contains properties 'complete' and 'wellCut'.
	 */
	public function fakerSentence($length = 250): object {
		$locale = (new TimeFcts())->appLocale();

		$faker                = FakerBase::create($locale);
		$completeFakeSentence = $faker->realText($length + 100, 3);

		return $this->cutSentence($completeFakeSentence);
	}

	/**
	 * Cut a sentence at the hyphen (., ;, !, ...) which is the closest to the given length.
	 *
	 * @param string $completeFakeSentence The sentence to cut.
	 * @param int $length The length of the sentence to generate.
	 * @return object Contains properties 'complete' and 'wellCut'.
	 */
	public function cutSentence($completeFakeSentence, $length = 200): object {
		$hyphens  = ['.', ';', '!', '...'];
		$position = $this->findLastHyphenPosition($completeFakeSentence, $length, $hyphens);

		$etc = ($position === $length) ? ' [...]' : '';
		// echo "{$position} - {$length}";
		$wellCut = substr($completeFakeSentence, 0, $position) . $etc;

		return (object) [
			'complete' => $completeFakeSentence,
			'wellCut'  => $wellCut,
		];

		// echo '<pre>';
		// print_r($this->sentence);
		// echo '</pre>';
	}

	/**
	 * Finds the position of the last hyphen in a string, given the length
	 * and the hyphens to search for.
	 *
	 * @param string $text The string to search.
	 * @param int $length The length of the string to search.
	 * @param array $hyphens The hyphens to search for.
	 * @return int The position of the last hyphen, or the length of the string if no hyphen is found.
	 */
	private function findLastHyphenPosition($text, $length, $hyphens): int {
		$positions = array_map(function ($hyphen) use ($text, $length) {
			return strrpos(substr($text, 0, $length), $hyphen);
		}, $hyphens);

		// Supprime les valeurs false et obtient la position maximale
		$positions = array_filter($positions, fn ($pos) => false !== $pos);

		return !empty($positions) ? max($positions) + 1 : $length;
	}
}
