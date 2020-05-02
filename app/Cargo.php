<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    public function miembros()
	{
		return $this->belongsToMany(Miembro::class)
		->withTimestamps();
	}
}
