<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;
use Database\Factories\MemberFactory;

class MembersSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$totalUser = 1e4;
		MemberFactory::setTotal($totalUser);
        echo "\n";
		Member::factory($totalUser)
			->create();
		// Member::factory()
		// ->setTotal(123)
		// ->count(123)
		// ->create();
		echo "\n";
	}
}