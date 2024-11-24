<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperCategory
 */
class Category extends Model {
	public $timestamps  = false;
	protected $fillable = ['title', 'slug'];

	/*protected
	 * Get the posts for the Category.
	 */
	public function posts(): HasMany {
		return $this->hasMany(Post::class);
	}
}
