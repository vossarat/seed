<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Auth;
use Func;

class HeaderInfoComposer {

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
        	'cnt' => 100,
        ]);
    }

}