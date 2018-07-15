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
	];
	
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
