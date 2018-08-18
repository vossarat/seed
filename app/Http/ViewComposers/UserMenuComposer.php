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
    	$titleprofile = 'Я трейдер';
    	$routeprofile = 'create';
    	$trader_id = '';
    	if( Auth::check() ){
	    	if( Func::traderByUserId(Auth::user()->id) ){
				$titleprofile = 'Профиль трейдера';
	    		$routeprofile = 'edit';
	    		$trader_id = Func::traderByUserId(Auth::user()->id);
			}
		}
		
		$titleprofileFarmer = 'Я фермер';
    	$routeprofileFarmer = 'create';
    	$farmer_id = '';
    	if( Auth::check() ){
	    	if( Func::farmerByUserId(Auth::user()->id) ){
				$titleprofileFarmer = 'Профиль фермера';
	    		$routeprofileFarmer = 'edit';
	    		$farmer_id = Func::farmerByUserId(Auth::user()->id);
			}
		}
		
        $view->with([
        	'username' => $username,
        	'titleprofile' => $titleprofile,
        	'routeprofile' => $routeprofile,
        	'trader_id' => $trader_id,
        	
        	'titleprofileFarmer' => $titleprofileFarmer,
        	'routeprofileFarmer' => $routeprofileFarmer,
        	'farmer_id' => $farmer_id,
        ]);
    }

}