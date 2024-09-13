<?php

namespace App\Models;

use App\Models\Submenu;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
public $timestamps = false;

protected $fillable = ['label', 'link', 'order'];

public function submenus(){

    return $this->hasMany(Submenu::class);
}

}
