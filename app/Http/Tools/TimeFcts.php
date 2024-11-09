<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

namespace App\Http\Tools;

class TimeFcts
{
	public function convertToLocale($languageCode)
	{
		// Utilise Locale pour convertir un code de langue en locale complète
		// ex.: fr → FR
		return \Locale::composeLocale(['language' => $languageCode, 'region' => strtoupper($languageCode)]);
	}
}
