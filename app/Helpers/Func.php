<?php
//app/Helpers/
namespace App\Helpers;
use App\User;
use App\Trader;
use Auth;
 
class Func {
    /**
     * @param int $user_id User-id
     * 
     * @return string
     */
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
}
