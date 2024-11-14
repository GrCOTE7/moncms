<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

namespace App\Http\Tools;

use Illuminate\Support\Facades\Config;

class TimeFcts {
	/**
	 * Return the locale for a given language code
	 *
	 * @return string The locale, ex.: fr → fr_FR
	 */
	public function appLocale(): bool|string {
		$languageCode = Config::get('app.locale');

		return \Locale::composeLocale(['language' => $languageCode, 'region' => strtoupper($languageCode)]);
	}
}
