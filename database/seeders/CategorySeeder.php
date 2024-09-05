<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		// $categories = [
		// 	[
		// 		'title' => 'Categorie 1',
		// 		'slug'  => 'category-1',
		// 	],
		// 	[
		// 		'title' => 'Categorie 2',
		// 		'slug'  => 'category-2',
		// 	],
		// 	[
		// 		'title' => 'Categorie 3',
		// 		'slug'  => 'category-3',
		// 	],
		// ];

		// foreach ($categories as $categoryData) {
		// 	Category::create($categoryData);
		// }

		$nbCategories = 3;

		for ($i = 1; $i <= $nbCategories; ++$i) {
			$title = "Catégorie $i";
			$slug  = Str::slug($title);

			Category::create(['title' => $title, 'slug' => $slug]);
		}
	}
}
