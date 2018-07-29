<?php

namespace App\Reference;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';
    
    protected $fillable = [
		'name',
	];
	
	public function state()
	{
		return $this->hasMany(State::class);
	}
}
