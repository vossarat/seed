<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
	
	/*protected $dates = [
        'created_at',
        'updated_at',
    ];*/
    
	protected $fillable = [
		'user_id',
		'title',
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
		'sort_standart', 
		'sort_other', 
		'sort_gost1', 
		'sort_gost2', 
		'agreement', 
		'rewrite', 
	];
	
	public function user()
	{
		return $this->belongsTo(User::class);
	}
	
	public function corn()
	{
	  	return $this->belongsTo('App\Reference\Corn');
	} 
	
	public function ScopeFilterByTitle($query, $filterByTitle)
	{
		return $query->where('title', 'like', "%$filterByTitle%" );
	}
}
