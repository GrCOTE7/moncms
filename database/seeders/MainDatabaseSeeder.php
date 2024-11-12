<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MainDatabaseSeeder extends Seeder
{
	public function run()
	{
		$namespace = 'Database\\Seeders\\Main\\';
		$seeders   = ['User', 'Category', 'Post', 'Page', 'Contact', 'Menus', 'Footer', 'Comment', 'Setting'];

		foreach ($seeders as $seeder) {
			$this->call("{$namespace}{$seeder}Seeder");
		}
	}
}
