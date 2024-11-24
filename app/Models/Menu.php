<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperMenu
 */
class Menu extends Model {
	public $timestamps  = false;
	protected $fillable = ['label', 'link', 'order'];

	public function submenus() {
		return $this->hasMany(Submenu::class);
	}
}
