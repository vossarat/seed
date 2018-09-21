<?php

namespace App\Reference;

use Illuminate\Database\Eloquent\Model;

class Gost extends Model
{
    protected $table = 'gosts';
    
    protected $fillable = [
		'name',
	];
	
	public function corns()
    {
        return $this->belongsToMany('App\Reference\Corn');
    } 
    
    public function orders()
    {
        return $this->belongsToMany('App\Reference\Order');
    } 
}
