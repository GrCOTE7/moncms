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
		Schema::create('members', function (Blueprint $table) {
			$table->id();
			$table->string('username')->unique();
			$table->string('firstname')->index();
			$table->string('name')->index();
			$table->string('email')->unique();
			$table->timestamps();

			$table->index(['username', 'name', 'email']);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::dropIfExists('members');
	}
};
