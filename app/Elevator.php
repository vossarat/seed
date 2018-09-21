<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Auth;

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
	
	public function ScopeFilterByState($query, $filterByState)
	{
		if($filterByState){
			return $query
	        	->leftJoin('towns as t',   'elevators.town_id', '=', 't.id')        		
	        	->leftJoin('regions as r', 't.region_id',   '=', 'r.id')  
	        		->where('r.state_id', '=', $filterByState)	;
		}
		
		return $query ;
	}
	
	public function ScopeFilterByRegion($query, $filterByRegion)
	{
		if($filterByRegion){
			return $query
	        	->leftJoin('towns as t', 'elevators.town_id', '=', 't.id')        		
	        	//->rightJoin('elevators', 'towns.id', '=', 'elevators.town_id')    
	        		->where('t.region_id', '=', $filterByRegion)	;
		}
		
		return $query ;
	}
	
	public function ScopeFilterByCorn($query, $filterByCorn)
	{
		if($filterByCorn){
			return $query				
	        	->leftJoin('corn_elevator', 'elevators.id', '=', 'corn_elevator.elevator_id') 
	        	->select('elevators.id', 'elevators.title')       		
	        		->whereIn('corn_elevator.corn_id', $filterByCorn)
	        		->distinct();
		}
		
		return $query ;
	}
	
	public function ScopeFilterByPriceMin($query, $filterByPriceMin)
	{
		if($filterByPriceMin){
			return $query				
	        		->where('price','>=', $filterByPriceMin);
		}
		
		return $query ;
	}
	
	public function ScopeFilterByPriceMax($query, $filterByPriceMax)
	{
		if($filterByPriceMax){
			return $query				
	        		->where('price','<=', $filterByPriceMax);
		}
		
		return $query ;
	}
	
	/**
	* 
	* @param undefined $query
	* @param undefined $user - авторизированный пользователь
	* 
	* @return $query к выборке добавляется столбец fav = "fa fa-star-o" когда $user = favorite_user_elevator.user_id
	* fa fa-star-o закрашенная звезда
	* иначе
	* fa fa-star незакрашенная звезда
	*/
	public function ScopeFavUserElevators($query, $user, $fav)
	{
		if($user){
			return $query				
        		->leftJoin('favorite_user_elevator', 'elevators.id', '=', 'favorite_user_elevator.elevator_id')
        		->leftJoin('towns', 'elevators.town_id', '=', 'towns.id')        		
	        	->leftJoin('regions', 'towns.region_id',   '=', 'regions.id') 
        		->select('elevators.*', 'favorite_user_elevator.elevator_id', 'regions.name as region_name',
        		DB::raw("CASE WHEN (favorite_user_elevator.user_id = $user) THEN 'fa fa-star' ELSE 'fa fa-star-o' END as fav"))
        		->where(
					function($query) use ($user, $fav){
						if($fav){
							$query->where('favorite_user_elevator.user_id', '=', $user);
						}
					});
		} else {
			return $query				
        		->leftJoin('favorite_user_elevator', 'elevators.id', '=', 'favorite_user_elevator.elevator_id')
        		->leftJoin('towns', 'elevators.town_id', '=', 'towns.id')        		
	        	->leftJoin('regions', 'towns.region_id',   '=', 'regions.id') 
        		->select('elevators.*', 'favorite_user_elevator.elevator_id', 'regions.name as region_name',
        		DB::raw("'fa fa-star-o' as fav"))
        		->where(
					function($query) use ($user, $fav){
						if($fav){
							$query->where('favorite_user_elevator.user_id', '=', $user);
						}
					});
		}		
		return $query ;
	}
	
	public function ScopeFav($query, $user)
	{
		if($user){
			return $query				
        		->leftJoin('favorite_user_elevator', 'elevators.id', '=', 'favorite_user_elevator.elevator_id') 
        		->select('elevators.id', 'elevators.title')
        		->where('favorite_user_elevator.user_id', '=', $user);
		}		
		return $query ;
	}
	
}
