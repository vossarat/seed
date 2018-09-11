<?php

namespace App\Reference;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
	
	public function farmers()
    {
        return $this->belongsToMany('App\Farmer');
    }
	
	public function scopeCountElevator($query, $id)
    {
        return $query
        	->rightJoin('towns', 'regions.id', '=', 'towns.region_id')        		
        	->rightJoin('elevators', 'towns.id', '=', 'elevators.town_id')    
        		->where('regions.id', '=', $id)		
        	->count();
    }
}
