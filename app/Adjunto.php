<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adjunto extends Model
{
    public function articulos()
	{
		return $this->belongsToMany(Articulo::class)
		->withTimestamps();
	}

	public function imgOrientation()
	{
		list($width, $height) = getimagesize(asset('storage/medios/'.$this->url));
		if($width > $height){
			$orientation = "horizontal";
		}
		else{
			$orientation = "vertical";
		}
		return $orientation;
	}
}
