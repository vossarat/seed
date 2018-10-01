<?php

namespace App\Reference;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $table = 'attributes';
    
    protected $fillable = [
		'name',
	];
	
	public function elevators()
    {
        return $this->belongsToMany('App\Elevator')->withPivot('attr_value');
    } 
}
