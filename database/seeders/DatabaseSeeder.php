<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		// User::factory(10)->create();

		$this->call([
			UserSeeder::class,
			CategorySeeder::class,
			PostSeeder::class,
			PageSeeder::class,
			MenusSeeder::class,
			FootermenusSeeder::class,
			CommentSeeder::class,
		]);

		printf('%s%s', str_repeat(' ', 2), "Data tables properly filled.\n\n");
	}
}
