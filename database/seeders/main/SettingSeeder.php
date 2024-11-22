<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

namespace Database\Seeders\Main;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder {
	public function run() {
		$settings = [
			['key' => 'pagination', 'value' => 6],
			['key' => 'excerptSize', 'value' => 30],
			['key' => 'title', 'value' => 'Mon CMS'],
			['key' => 'subTitle', 'value' => 'Mon Blog pour apprendre LARAVEL'],
			['key' => 'newPost', 'value' => 4],
		];

		DB::table('settings')->insert($settings);
	}
}
