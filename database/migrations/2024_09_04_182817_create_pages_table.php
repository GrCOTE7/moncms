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
		Schema::create('pages', function (Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->string('slug');
			$table->mediumText('body');
			$table->boolean('active')->default(false);
			$table->string('seo_title');
			$table->text('meta_description');
			$table->text('meta_keywords');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::dropIfExists('pages');
	}
};
