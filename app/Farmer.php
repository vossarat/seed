<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    protected $table = 'farmers';	

	protected $fillable = [
		'user_id',
		'title',
		'fio',
		'volume',
		'sms',
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

