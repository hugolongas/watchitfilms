<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function adjuntos()
	{
		return $this->belongsToMany(Adjunto::class)
		->withTimestamps();
	}

	public function categoria()
	{
		return $this->belongsTo(Categoria::class);
	}

	public function slug()
	{
		$cat = strtolower($this->categoria->name);
		return 'http://'.config('app.base_domain').'/'.$cat.'/'.$this->url;
	}

	public function hasCredits()
	{
		$credits = false;
		$direccion =$this->direccion;
		$produccion =$this->produccion;
		$post_produccion =$this->post_produccion;
		$fotografo =$this->fotografo;
		$credits = $this->direccion!="" || $this->produccion!="" || $this->post_produccion!="" || $this->fotografo!="" ;
		return $credits;
	}
}
