<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\User;
use App\Trader;
use App\Farmer;
use App\Elevator;
use App\Forwarder;
use Auth;
use Func;

class DashboardComposer {

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
	
        $view->with([
        	'cntUser' => User::count(),
        	'cntTrader' => Trader::count(),
        	'cntFarmer' => Farmer::count(),
        	'cntElevator' => Elevator::count(),
        	'cntForwarder' => Forwarder::count(),
        ]);
    }

}