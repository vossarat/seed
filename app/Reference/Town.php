<?php

namespace App\Reference;

use Illuminate\Database\Eloquent\Model;

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
}
