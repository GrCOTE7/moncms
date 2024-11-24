<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperPage
 */
class Page extends Model {
	use HasFactory;

	public $timestamps  = false;
	protected $fillable = [
		'title',
		'slug',
		'body',
		'active',
		'seo_title',
		'meta_description',
		'meta_keywords',
		'pinned',
		'created_at',
		'updated_at',
	];
}
