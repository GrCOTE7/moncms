<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Member extends Model
{
	use HasFactory;

	// protected $fillable = [
	// 	'name',
	// 	'username',
	// 	'email',
	// ];
	public function project(): BelongsTo
	{
		return $this->belongsTo(Project::class, 'project_id');
	}
}