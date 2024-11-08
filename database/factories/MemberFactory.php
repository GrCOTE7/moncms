<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{
	protected static $nb    = 0;
	protected static $total = 0;

	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		++static::$nb;

		$modulo = static::$total / 10;

		if (0 === static::$nb % $modulo || static::$nb === static::$total) {
			echo str_repeat(' ', 4) . 'Member # ' . str_pad(number_format(static::$nb, 0, ',', ' '), 7, ' ', STR_PAD_LEFT) . ' / ' . number_format(static::$total, 0, ',', ' ') . "\n";
		}

        // 1ere reg: '/^\p{L}[-\p{L}]*\s+/u'

        $userName       = ucfirst(fake('fr_FR')->unique()->userName());
        $fullName = fake('fr_FR')->name();

        preg_match('/^[\p{L}-]+/u', $fullName, $matches);


		return [
			'username'   => $userName,
			'firstname'  => $matches[0],
			'name'       => strtoupper(trim(substr($fullName,strlen($matches[0])))),
			'email'      => strtolower($userName) . '@example.com',
			'project_id' => Project::factory(),
		];
	}

	public static function setTotal(int $total)
	{
		static::$total = $total;
	}
}