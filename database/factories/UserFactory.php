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
class UserFactory extends Factory {
	public static $users = [];

	/**
	 * The current password being used by the factory.
	 */
	protected static ?string $password;

	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array {
		// [$name, $email] = $this->uniqueUsersEmail();
		[$name, $email] = $this->uniqueUserNameAndEmail();

		return [
			'name'           => $name,
			'email'          => $email,
			'password'       => static::$password ??= Hash::make('password'),
			'remember_token' => Str::random(10),
			'valid'          => true,
		];
	}

	/**
	 * Indicate that the model's email address should be unverified.
	 */
	public function unverified(): static {
		return $this->state(fn (array $attributes) => [
			'email_verified_at' => null,
		]);
	}

	public function uniqueUserNameAndEmail() {
		static $names;

		$name = fake('fr_FR')->lastname();
		// $name = $this->fakeFakes();
		if (!isset($names[$name])) {
			$names[$name] = 1;

			self::$users[] = $pseudo = $name;
		} else {
			$names[$name]++;
			$pseudo = self::$users[] = $name . '-' . ($names[$name] - 1);
		}

		$email = strtolower(str_replace(' ', '_', $pseudo) ) . '@example.com';

		return [$name, $email];
	}

	// private function fakeFakes() {
	// 	static $n  = 0;
	// 	$fakeFakes = ['a', 'b', 'a', 'b', 'd', 'a', 'e'];

	// 	return $fakeFakes[$n++ % count($fakeFakes)];
	// }
}
