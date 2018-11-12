<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Auth;

class Farmer extends Model
{
    protected $table = 'farmers';	

	protected $fillable = [
		'user_id',
		'title',
		'fio',
		'volume',
		'sms',
		'state_id',
		'region_id',
	];
	
	public function user()
	{
		return $this->belongsTo(User::class);
	}
	
	public function corns()
    {
        return $this->belongsToMany('App\Reference\Corn');
    }
    
    public function regions()
    {
        return $this->belongsToMany('App\Reference\Region');
    }
    
    public static function profileTitle()
	{
		return 'Фермер';
	}
	
	public static function id()
	{		
		$user = User::find( Auth::id() );
		return $user->farmer->id;
	}
	
	public static function otherProfiles()
	{		
		return array( 
			array('tip' => 'trader', 'title'=> 'Трейдер'),		
			array('tip' => 'forwarder', 'title'=> 'Экспедитор'),		
		);
	}
    
    public function ScopeFarmersPhonesByCorn($query, $corn_id)
	{		
			$farmers = $query
				->select('users.name as farmername', 'users.phone as phone', 'users.email as email')
				->leftJoin('users', 'farmers.user_id', '=', 'users.id')
				->rightJoin('corn_farmer', 'farmers.id', '=', 'corn_farmer.farmer_id')				
				->where('corn_farmer.corn_id', '=' , $corn_id)
				->distinct()
				->get();

			$farmerPhones = [];
			foreach($farmers as $farmer){
				if( empty($farmer['phone']) ){			        
			        continue;
			    }
				$farmerPhones[] = preg_replace("/[^0-9]/", '',  $farmer['phone']); // убираем все кроме цифр
			}
			return $farmerPhones;
	}
	
	public function ScopeFarmersEmailsByCorn($query, $corn_id)
	{		
			$farmers = $query
				->select('users.name as farmername', 'users.phone as phone', 'users.email as email')
				->leftJoin('users', 'farmers.user_id', '=', 'users.id')
				->rightJoin('corn_farmer', 'farmers.id', '=', 'corn_farmer.farmer_id')				
				->where('corn_farmer.corn_id', '=' , $corn_id)
				->distinct()
				->get();
			
			$farmerEmails = [];
			foreach($farmers as $farmer){
				if( filter_var($farmer['email'], FILTER_VALIDATE_EMAIL) == false ) {			        
			        continue;
			    }
				$farmerEmails[] = $farmer['email'];
			}
			
			return $farmerEmails;
	}
}

