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
		'title',
		'user_id',
		'town_id',
		'price',
		'username',
		'description',
		'email',
		'phone',
		'whatsapp',
	];
	
	public function user()
	{
		return $this->belongsTo(User::class);
	}
	
	public function corns()
    {
        return $this->belongsToMany('App\Reference\Corn');
    }
    
    public function orders()
    {
        return $this->belongsToMany('App\Order');
    }
    
    public function town()
	{
		return $this->belongsTo('App\Reference\Town');
	}
}
