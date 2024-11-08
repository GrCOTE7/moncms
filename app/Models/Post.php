<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany,HasMany};

class Post extends Model
{
	use HasFactory;

	protected $fillable = ['title', 'slug', 'body', 'active', 'image', 'user_id', 'category_id', 'seo_title', 'meta_description', 'meta_keywords', 'pinned'];

	/**
	 * Get the user that owns the Post.
	 */
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	/**
	 * Get the category that owns the Post.
	 */
	public function category(): BelongsTo
	{
		return $this->belongsTo(Category::class);
	}

	public function comments(): HasMany
	{
		return $this->hasMany(Comment::class);
	}

	public function validComments(): HasMany
	{
		return $this->comments()->whereHas('user', function ($query) {
			$query->whereValid(true);
		});
	}

	/**
	 * Get the users that have favorited the Post.
	 */
	public function favoritedByUsers(): BelongsToMany
	{
		return $this->belongsToMany(User::class, 'favorites');
	}
}
