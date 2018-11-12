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
		return $this->belongsTo(State::class);
	}
	
	public function farmers()
    {
        return $this->belongsToMany('App\Farmer');
    }
	
	public function scopeCountElevator($query, $id)
    {
        return $query
        	->rightJoin('elevators', 'regions.id', '=', 'elevators.region_id')    
        		->where('regions.id', '=', $id)		
        	->count();
    }
}
