<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    protected $table = 'farmers';	

	protected $fillable = [
		'user_id',
		'title',
		'fio',
		'volume',
		'sms',
		'region_id',
	];
	
	public function user()
	{
		return $this->belongsTo(User::class);
	}
	
	public function corns()
    {
        return $this->belongsToMany('App\Reference\Corn');
    }
    
    public function regions()
    {
        return $this->belongsToMany('App\Reference\Region');
    }
}
