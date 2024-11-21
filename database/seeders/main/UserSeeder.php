<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

namespace Database\Seeders\Main;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$users = [
			[
				'name'       => 'Admin',
				'email'      => 'admin@example.com',
				'role'       => 'admin',
				'created_at' => Carbon::now()->subYears(3),
				'updated_at' => Carbon::now()->subYears(3),
			],
			[
				'name'       => 'Redac',
				'email'      => 'redac@example.com',
				'role'       => 'redac',
				'created_at' => Carbon::now()->subYears(3),
				'updated_at' => Carbon::now()->subYears(3),
			],
			[
				'name'       => 'User',
				'email'      => 'user@example.com',
				'role'       => 'user',
				'created_at' => Carbon::now()->subYears(2),
				'updated_at' => Carbon::now()->subYears(2),
			],
			[
				'name'       => env('MAIL_FROM_USER', 'Moi'),
				'email'      => env('MAIL_FROM_ADDRESS', 'moi@example.com'),
				'role'       => 'admin',
				'created_at' => Carbon::now()->subYears(3),
				'updated_at' => Carbon::now()->subYears(3),
			],
		];

		foreach ($users as $userData) {
			User::factory()->create($userData);
		}

		User::factory(3)->create();

        $u = User::find(6);
        $u->valid       = false;
        $u->save();
	}
}
