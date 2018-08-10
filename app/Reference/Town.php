<?php

namespace App\Reference;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Town extends Model
{
    protected $table = 'towns';
    
    protected $fillable = [
		'name',
		'region_id',
	];
	
	public function region()
	{
		return $this->belongsTo(Region::class);
	}
	
	public function elevator()
	{
		return $this->hasMany('App\Elevator');
	}
	
	public function scopeCountElevator($query, $id)
    {
        return $query     		
        	->rightJoin('elevators', 'towns.id', '=', 'elevators.town_id')    
        		->where('towns.id', '=', $id)		
        	->count();
    }
    
    
}
