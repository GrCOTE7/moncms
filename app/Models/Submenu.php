<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperSubmenu
 */
class Submenu extends Model {
	public $timestamps  = false;
	protected $fillable = [
		'label',
		'order',
		'link',
	];
}
