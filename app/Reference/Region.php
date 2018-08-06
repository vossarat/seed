<?php

namespace App\Reference;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'regions';
    
    protected $fillable = [
		'name',
		'state_id',
	];
	
	public function state()
	{
		return $this->hasMany(State::class);
	}
}
