<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
	/**
	 * The current password being used by the factory.
	 */
	protected static ?string $password;

	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		$name = fake('fr_FR')->lastname();

		return [
			'name'           => $name,
			'email'          => strtolower($name) . '@example.com',
			'password'       => static::$password ??= Hash::make('password'),
			'remember_token' => Str::random(10),
			'valid'          => true,
		];
	}

	/**
	 * Indicate that the model's email address should be unverified.
	 */
	public function unverified(): static
	{
		return $this->state(fn (array $attributes) => [
			'email_verified_at' => null,
		]);
	}

	public function uniqueNames()
	{
		$names      = [];
		$nameCounts = []; // Un tableau pour suivre le nombre de duplications

		for ($i = 0; $i < 10000; ++$i) {
			$name = fake('fr_FR')->lastname();

			// Vérifie si le nom existe déjà dans le tableau $nameCounts
			if (isset($nameCounts[$name])) {
				// Augmente le compteur et ajoute-le au nom
				++$nameCounts[$name];
				$nameWithOrder = $name . $nameCounts[$name];
				$names[]       = $nameWithOrder;
			} else {
				// Ajoute le nom original au tableau $names et initialise son compteur
				$names[]           = $name;
				$nameCounts[$name] = 0;
			}
		}
		// sort($names);
		echo '<pre>';
		print_r($names);
		echo '</pre>';
	}
}
