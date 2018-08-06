<?php

namespace App\Reference;

use Illuminate\Database\Eloquent\Model;

class Corn extends Model
{
	
	protected $table = 'corns';
    
    protected $fillable = [
		'name',
	];
	
	
    public function elavators()
    {
        return $this->belongsToMany('App\Elevator');
    }
    
    public function order()
	{
		return $this->hasOne('App\Order');
	}
}
