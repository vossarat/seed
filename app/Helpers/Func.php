<?php
//app/Helpers/
namespace App\Helpers;
use App\User;
use App\Trader;
use App\Farmer;
use App\Forwarder;
use Auth;
 
class Func {
    
	/**
	* /
	* @param undefined $userId
	* Так как профиль может быть только один из трех
	* то сканируем наличие id user в таблица профилей
	* @return id профиля 
	*/    
    public static function idByProfile($userId) 
    {
    	$user = User::find( $userId );
    	
    	if($user->farmer){
			return $user->farmer->id;
		}
		
		if($user->trader){
			return $user->trader->id;
		} 
		
		if($user->forwarder){
			return $user->forwarder->id;
		}    	    	
    	
    }
    
    public static function phoneOnlyNumber($phoneNumber) 
    {
    	$phoneOnlyNumber = preg_replace("/[^0-9]/", '',  $phoneNumber); // убираем все кроме цифр
	                
        return $phoneOnlyNumber;
    }
    
    public static function profile($profileValue) 
    {
    	switch ($profileValue) {
		    case 'farmer':
		        $profile = array('title' => 'Фермер', 'model' => 'Farmer');
		        break;
		    case 'trader':
		        $profile = array('title' => 'Трейдер', 'model' => 'Trader');
		        break;
		    default:
				$profile = array('title' => 'Экспедитор', 'model' => 'Forwarder');
		}
	                
        return $profile;
    }
	
	public static function traderByUserId($userId) 
    {
    	$user = User::find( $userId );
    	
    	$traderId = $user->trader ? $user->trader->id : 0;
    	
/*    	// переменные для создания или редактирования профиля поставщика
    	$action = 'create';
		$id = 0;
    	
    	if(isset($trader)){
			$action = 'edit';
			$id = $trader;
		}    */ 	                
        return $traderId;
    }
    
    public static function farmerByUserId($userId) 
    {
    	$user = User::find( $userId );    	
    	$farmerId = $user->farmer ? $user->farmer->id : 0;
	                
        return $farmerId;
    }
}