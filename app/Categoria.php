<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    
	public function slug()
	{
		$cat = strtolower($this->name);
		return 'http://'.config('app.base_domain').'/'.$cat;
	}

}
