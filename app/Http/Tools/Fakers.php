<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

namespace App\Http\Tools;

use Faker\Factory as FakerBase;

class Fakers
{
	public function completeFakeSentences($length = 150, $locale = null): object
	{
		if (!$locale) {
			$localeConverter = new TimeFcts();
			$locale          = $localeConverter->convertToLocale(env('APP_LOCALE', 'en'));
		}

		$faker                 = FakerBase::create($locale);
		$completeFakeSentences = $faker->realText(min($length + 100, 200), 3);

		$positionPoint        = strrpos(substr($completeFakeSentences, 0, $length), '.');
		$positionPointVirgule = strrpos(substr($completeFakeSentences, 0, $length), ';');
		$positionPointExcla   = strrpos(substr($completeFakeSentences, 0, $length), '!');
		$positionPointTrois   = strrpos(substr($completeFakeSentences, 0, $length), '...');
		$etc                  = ' [...]';

		try {
			$position = max($positionPoint, $positionPointVirgule, $positionPointExcla, $positionPointTrois);
			++$position;
			$etc = '';
		} catch (\Exception $e) {
			$position = $length;
		}

		$wellCut = substr($completeFakeSentences, 0, $position) . $etc;

		try {
			$sentencesO = json_decode(json_encode([
				'complete' => $completeFakeSentences,
				'wellCut'  => $wellCut,
			]));
			if (!is_object($sentencesO)) {
				throw new \Exception('Conversion en objet a échoué.');
			}
		} catch (\Exception $e) {
			echo 'Error: ' . $e->getMessage() . "\n";
			$usentencesO = (object) [
				'complete' => $completeFakeSentences,
				'wellCut'  => $wellCut,
			];
		}

		return $sentencesO;
	}
}