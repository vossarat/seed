<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Auth;
use Func;

class UserMenuComposer {

    public function __construct()
    {
        // Зависимости разрешаются автоматически службой контейнера...
        //$this->users = $users;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
    	$username = Auth::check() ? Auth::user()->name  : 'Пользователь';
    	$profile_type = '';
    	$profile_action = '';
    	$profile_id = '';
    	
    	if( Auth::check() ){
	    	
	    	$profile_action = 'create';	    	
	    	$profile_type = Auth::user()->profile; // трейдер или фермер
	    	$profile_id = 0;
	    	
	    	if( Func::traderByUserId(Auth::user()->id) ){
	    		$profile_action = 'edit';
	    		$profile_id = Func::traderByUserId(Auth::user()->id);
			}
			
			if( Func::farmerByUserId(Auth::user()->id) ){
	    		$profile_action = 'edit';
	    		$profile_id = Func::farmerByUserId(Auth::user()->id);
			}
		}
	
        $view->with([
        	'username' => $username,
        	'profile_type' => $profile_type,
        	'profile_action' => $profile_action,
        	'profile_id' => $profile_id,
        ]);
    }

}