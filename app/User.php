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
        'name', 'email', 'profile', 'password', 'phone', 'whatsapp', 'telegram',
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
	
	public function ScopeFarmersEmailByCorn($query, $corns)
	{
		if( $corns ){
			return $query
				->select('email')
				->leftJoin('farmers', 'users.id', '=', 'farmers.user_id')
				->leftJoin('corn_farmer', 'farmers.id', '=', 'corn_farmer.farmer_id')
        		->whereIn('corn_farmer.corn_id', $corns) ;
		}
		
		return $query ;
	}
	
	public function ScopeFarmersPhoneByCorn($query, $corns)
	{
		if( $corns ){
			return $query
				->select('phone')
				->leftJoin('farmers', 'users.id', '=', 'farmers.user_id')
        		->whereIn('users.id', $corns) ;
		}
		
		return $query ;
	}
	
}
