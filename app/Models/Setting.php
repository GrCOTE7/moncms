<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperSetting
 */
class Setting extends Model {
	public $timestamps  = false;
	protected $fillable = ['key', 'value'];
}
