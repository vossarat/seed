<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Auth;

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
	
	public static function profileTitle()
	{
		return 'Трейдер';
	}
	
	public static function id()
	{		
		$user = User::find( Auth::id() );
		return $user->trader->id;
	}
	
	public static function otherProfiles()
	{		
		return array( 
			array('tip' => 'farmer', 'title'=> 'Производитель СХП'),		
			array('tip' => 'forwarder', 'title'=> 'Экспедитор'),		
		);
	}
	
}
