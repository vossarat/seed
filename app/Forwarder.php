<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forwarder extends Model
{
    protected $table = 'forwarders';	

	protected $fillable = [
		'user_id',
		'title',
		'transport_tip',
		'transport_cnt',
		'sms',
	];
	
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
