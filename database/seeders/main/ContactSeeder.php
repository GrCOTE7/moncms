<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

namespace Database\Seeders\Main;

use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
	use WithoutModelEvents;

	public function run()
	{
		Contact::factory()->count(5)->create();
	}
}
