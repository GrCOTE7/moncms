<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::create('posts', function (Blueprint $table) {
			$table->id();
			$table->string('title');

			$table->foreignId('user_id')
				->constrained()
				->onDelete('cascade')
				->onUpdate('cascade');

			$table->foreignId('category_id')
				->constrained()
				->onDelete('cascade')
				->onUpdate('cascade');

			$table->boolean('active')->default(false);
			$table->string('slug')->unique;
			$table->mediumText('body');
			$table->string('image')->nullable();
			$table->string('seo_title');
			$table->text('meta_description');
			$table->text('meta_keywords');
			$table->boolean('pinned')->default(false);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::dropIfExists('posts');
	}
};
