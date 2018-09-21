<?php

namespace App\Reference;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $table = 'rates';
    
    protected $fillable = [
		'usd',
		'eur',
		'rub',
	];
}
