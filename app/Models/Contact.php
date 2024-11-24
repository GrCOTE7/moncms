<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

/**
 * @mixin IdeHelperContact
 */
class Contact extends Model {
	use HasFactory;
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'message', 'user_id'];

	/**
	 * Get user of the Contact.
	 */
	public function user(): BelongsTo {
		return $this->belongsTo(User::class);
	}
}
