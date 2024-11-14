<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

namespace Database\Factories;

use App\Http\Tools\{Fakers, TimeFcts};
use App\Models\Contact;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory {
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = Contact::class;

	/**
	 * Define the model's default state.
	 */
	public function definition(): array {
		$localeConverter = new TimeFcts();
		$locale          = $localeConverter->appLocale();

		$faker     = Faker::create($locale);
		$fakerTool = new Fakers();

		return [
			'name'    => $faker->name,
			'email'   => $faker->unique()->safeEmail,
			'message' => $fakerTool->fakerSentence()->wellCut,
		];
	}
}
