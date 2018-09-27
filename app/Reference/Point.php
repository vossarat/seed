<?php

namespace App\Reference;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $table = 'points';
    
    protected $fillable = [
		'name',
	];
	
	
}
