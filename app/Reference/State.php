<?php

namespace App\Reference;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
	protected $table = 'states';
	
    public function scopeCountElevator($query, $id)
    {
        return $query
        	->rightJoin('regions',   'states.id',  '=', 'regions.state_id')        		
        	->rightJoin('towns',     'regions.id', '=', 'towns.region_id')        		
        	->rightJoin('elevators', 'towns.id',   '=', 'elevators.town_id')    
        		->where('states.id', '=', $id)		
        	->count();
    } 
    
}
