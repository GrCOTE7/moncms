<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

namespace Database\Factories;

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

        $modulo         = static::$total / 10;

		if (0 === static::$nb % $modulo || static::$nb === static::$total) {
			echo '  Member # ' .
              str_pad(number_format(static::$nb, 0, ',', ' '),7,' ', STR_PAD_LEFT)
               . ' / ' . number_format(static::$total, 0, ',', ' ') . "\n";
			// echo '  Member # ' . sprintf('% 7d', static::$nb) . ' / ' . static::$total . "\n";
		}

		return [
			'name'     => fake()->name(),
			'username' => fake()->unique()->userName(),
			'email'    => fake()->unique()->safeEmail(),
		];
	}

	public static function setTotal(int $total)
	{
		static::$total = $total;
	}
}