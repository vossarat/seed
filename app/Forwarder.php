<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Auth;

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
	
	public static function profileTitle()
	{
		return 'Экспедитор';
	}
	
	
	public static function id()
	{		
		$user = User::find( Auth::id() );
		return $user->forwarder->id;
	}
	
	public static function otherProfiles()
	{		
		return array( 
			array('tip' => 'farmer', 'title'=> 'Производитель СХП'),		
			array('tip' => 'trader', 'title'=> 'Трейдер'),		
		);
	}
}
