<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Miembro extends Model
{
    public function cargos()
	{
		return $this->belongsToMany(Cargo::class)
		->withTimestamps();
	}

	

    public function hasCargo($cargo)
    {
		$cargo_id = $cargo->id;
		if ($this->cargos->where('id', $cargo_id)->first()) {
            return true;
        }
        return false;
    }
}
