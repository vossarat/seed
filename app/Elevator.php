<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Elevator extends Model
{
    protected $table = 'elevators';
	
	/*protected $dates = [
        'created_at',
        'updated_at',
    ];*/
    
	protected $fillable = [
		'user_id',
		'name',
		'description',
		'count',
		'price',
	];
}
