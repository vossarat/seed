<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trader extends Model
{
    protected $table = 'traders';
	
	/*protected $dates = [
        'created_at',
        'updated_at',
    ];*/
    
	protected $fillable = [
		'user_id',
		'title',
		'category',
		'sms',
	];
	
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
