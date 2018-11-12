<?php

namespace App\Reference;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
	protected $table = 'states';
	
	protected $fillable = [
		'name',
	];
	
    public function scopeCountElevator($query, $id)
    {
        return $query      		
        	->rightJoin('elevators', 'states.id',   '=', 'elevators.state_id')    
        		->where('states.id', '=', $id)		
        	->count();
    } 
    
}
