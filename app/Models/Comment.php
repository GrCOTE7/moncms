<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};
use Illuminate\Notifications\Notifiable;
use Mews\Purifier\Casts\CleanHtmlInput;

class Comment extends Model {
	use HasFactory;
	use Notifiable;

	protected $fillable = [
		'body',
		'post_id',
		'user_id',
		'parent_id',
	];
	protected $casts = [
		'body' => CleanHtmlInput::class,
	];

	public function user(): BelongsTo {
		return $this->belongsTo(User::class);
	}

	public function getDepth(): int {
		return $this->parent ? $this->parent->getDepth() + 1 : 0;
	}

	public function post(): BelongsTo {
		return $this->belongsTo(Post::class);
	}

	public function parent(): BelongsTo {
		return $this->belongsTo(Comment::class, 'parent_id');
	}

	public function children(): HasMany {
		return $this->hasMany(Comment::class, 'parent_id');
	}
}
