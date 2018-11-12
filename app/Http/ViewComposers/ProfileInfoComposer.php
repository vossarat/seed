<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Auth;
use Func;

class ProfileInfoComposer {

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
     
    public function username() 
    {
		return Auth::user()->name;
	}
	
	public function otherProfiles( $currentProfile ) 
    {
    	$allProfiles = array('farmer','trader','forwarder');
    	$otherProfiles = [];
		foreach( $allProfiles as $profile ) {
			if( $profile != $currentProfile ) {
				$otherProfiles[] = $profile;
			}
		}
		
		return $otherProfiles;
	}
	
    public function compose(View $view)
    {
    	if(Auth::check()){
			$profileModel = 'App\\'.ucfirst( Auth::user()->profile ) ;
	    	$profileTitle = $profileModel::profileTitle();
	    	$profileId = $profileModel::id();
	    	$otherProfiles = $profileModel::otherProfiles();
	    	
		
	        $view->with([
	        	'username' => $this->username(),
	        	'profileTitle' => $profileTitle ,
	        	'profile' =>  Auth::user()->profile,
	        	'profileId' => $profileId ,
	        	//'otherProfiles' => $this->otherProfiles( Auth::user()->profile ) ,
	        	'otherProfiles' => $otherProfiles ,
        	]);
		} else {
			$view->with([
	        	'username' => 'Гость',
	        	'profileTitle' => 'Гость' ,
        	]);
		}
    	
    }

}