<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

namespace Database\Seeders;

use App\Models\{Member, Project};
use Database\Factories\MemberFactory;
use Illuminate\Database\Seeder;

class MembersSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$totalUser = 1e5; // 1e5
		echo "\n";
		MemberFactory::setTotal($totalUser);
		for ($i = 1; $i <= $totalUser / 5; ++$i) {
			Member::factory(5)
				->for(Project::factory())
				->create();
		}
		echo "\n";

		// Member::factory($totalUser)
		// 	->create();
	}
}