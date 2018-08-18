<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Trader;
use App\Farmer;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'whatsapp', 'telegram',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function trader()
	{
		return $this->hasOne(Trader::class);
	}
	
	public function farmer()
	{
		return $this->hasOne(Farmer::class);
	}
	
	public function order()
	{
		return $this->hasOne(Order::class);
	}
	
	public function elevator()
	{
		return $this->hasOne(Elevator::class);
	}
	
}
