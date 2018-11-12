<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wagon extends Model
{
    protected $table = 'wagons';
	
	protected $dates = [
        'created_at',
        'updated_at',
        'date_delivery',
    ];
    
	protected $fillable = [
		'user_id',
		'transport_tip',
		'elevator_id',
		'point_id',
		'address_supply',
		'date_delivery',
		'corn_id',
		'price',
		'price',
		'nds',
		'count',
		'pack_id',
	];
	
	public function user()
	{
		return $this->belongsTo(User::class);
	}
	
	public function elevator()
    {
        return $this->belongsTo('App\Elevator');
    }
	
	public function corn()
	{
	  	return $this->belongsTo('App\Reference\Corn');
	}
	
	public function pack()
	{
	  	return $this->belongsTo('App\Reference\Pack');
	}
	
	public function point()
	{
	  	return $this->belongsTo('App\Reference\Point');
	}
}
