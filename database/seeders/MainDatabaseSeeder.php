<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MainDatabaseSeeder extends Seeder {
	private string $namespace = 'Database\\Seeders\\Main\\';
	private array $seeders    = ['User', 'Category', 'Post', 'Page', 'Contact', 'Menus', 'Footer', 'Comment', 'Setting'];

	public function run() {
		foreach ($this->seeders as $seeder) {
			$this->call("{$this->namespace}{$seeder}Seeder");
		}
	}
}
