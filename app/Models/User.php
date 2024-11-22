<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{BelongsToMany, HasMany};
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
	use HasFactory;
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
		'role',
		'valid',
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	public function comments(): HasMany {
		return $this->hasMany(Comment::class);
	}

	public function validComments(): HasMany {
		return $this->comments()->whereHas('user', function ($query) {
			$query->whereValid(true);
		});
	}

	/**
	 * Get the favorite posts of the user.
	 */
	public function favoritePosts(): BelongsToMany {
		return $this->belongsToMany(Post::class, 'favorites');
	}

	public function isAdmin(): bool {
		return 'admin' === $this->role;
	}

	public function isRedac(): bool {
		return 'redac' === $this->role;
	}

	public function isAdminOrRedac(): bool {
		return 'admin' === $this->role || 'redac' === $this->role;
	}

	/**
	 * Get the posts for the User.
	 */
	public function posts(): HasMany {
		return $this->hasMany(Post::class);
	}

	/**
	 * Get the attributes that should be cast.
	 *
	 * @return array<string, string>
	 */
	protected function casts(): array {
		return [
			'email_verified_at' => 'datetime',
			'password'          => 'hashed',
		];
	}
}
