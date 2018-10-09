<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    protected $table = 'orders';
	
	/*protected $dates = [
        'created_at',
        'updated_at',
    ];*/
    
	protected $fillable = [
		'user_id',
		//'title',
		'description',
		'count',
		'price',
		'auction',
		'pack_id',
		'corn_id',
		'loadprice_id', //наличие погрузки в цене
		'elevator_id', //элеватор
		'point_id', //пункт приема
		'point_name', //населенный пункт из див другой
		'point_adress', //адрес населенный пункт из див другой
		'class_corn', 
		'sort_standart', 
		'sort_other', 
		'sort_gost1', 
		'sort_gost2', 
		'agreement', 
		'rewrite', 
		'notice', 
	];
	
	public function user()
	{
		return $this->belongsTo(User::class);
	}
	
	public function elevators()
    {
        return $this->belongsToMany('App\Elevator', 'order_elevator');
    }
	
	public function corn()
	{
	  	return $this->belongsTo('App\Reference\Corn');
	}
	
	public function gosts()
    {
        return $this->belongsToMany('App\Reference\Gost');
    } 
	
	public function ScopeFilterByTitle($query, $filterByTitle)
	{
		return $query->where('title', 'like', "%$filterByTitle%" );
	}
	
	public function ScopeOrderToElevator($query, $order)
	{
		return $query				
        		->leftJoin('order_elevator', 'orders.id', '=', 'order_elevator.order_id')
        		->where('order_elevator.order_id', '=', $order);
	}
	
	public function ScopeFilterByCorn($query, $filterByCorn)
	{
		if($filterByCorn){
			return $query				
        		->whereIn('orders.corn_id', $filterByCorn);
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
	
	public function ScopeFilterByRegion($query, $filterByRegion)
	{
		if($filterByRegion){
			return $query
				->select('orders.*')
				->leftJoin('order_elevator', 'orders.id', '=', 'order_elevator.order_id')
				->leftJoin('elevators', 'order_elevator.elevator_id', '=', 'elevators.id')
	        	->leftJoin('towns', 'elevators.town_id', '=', 'towns.id')        		
        		->where('towns.region_id', '=', $filterByRegion)	;
		}
		
		return $query ;
	}
	
	public function ScopePack($query)
	{		
			return $query
				->select('packs.name as packname')
				->leftJoin('packs', 'orders.pack_id', '=', 'packs.id')
				->first();
	}
}
