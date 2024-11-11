<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
	public $timestamps  = false;
	protected $fillable = [
		'label',
		'link',
		'order',
	];
}
