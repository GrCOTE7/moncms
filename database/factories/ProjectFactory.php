<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'name'     => $this->faker->word,
			'start_at' => $this->faker->dateTime()->format('Y-m-d H:i:s'),
		];

    }
}