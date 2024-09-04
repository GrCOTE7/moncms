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

		User::factory()->create([
			'name'  => 'Test User',
			'email' => 'test@example.com',
		]);

		printf('%s%s', str_repeat(' ', 2), "Data tables properly filled.\n\n");
	}
}
