<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Trader;
use App\Farmer;
use App\Forwarder;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Mail;
use Auth;
use Func;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
    	$this->request = $request;
        $this->middleware('guest');
    } 
    
    protected function redirectTo()
	{
		$route = $this->request->profile;
		
		$id = Func::idByProfile( Auth::id() ); // из Func
		
	    return route("$route.edit", $id);
	    
	}

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, 
        	[
	        	//'email' => 'required|string|email|max:255|unique:users',
	        	'name' => 'required|max:255|unique:users',
	            'password' => 'required|string|min:6|confirmed',
            ],
            
            [
            
	            'name.required' => 'укажите Имя пользователя',
	            'name.unique' => 'Пользователь с таким именем уже зарегистрирован',
	            
	            'password.min' => 'Пароль должен содержать не менее 6 символов',
	            'password.confirmed' => 'Неправильное подтверждение пароля',
	            'password.required' => 'Заполните пароль',
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {	    
        $userProfile = Func::profile($data['profile']);
        $userProfileTitle = $userProfile['title'];
        $userProfileModel = 'App\\' . $userProfile['model'];
        
        //dd( $userProfile['name']);
            
        Mail::send('auth.admin_email', [ 'viewdata' => $data, 'profile' => $userProfileTitle ], function ($message) use ( $data, $userProfileTitle ) {
		    $message->from('admin@zelenka.trade', 'ZELENKA.TRADE');
			$message->to( env('MAIL_USERNAME',false), '')->subject('Регистрация нового пользователя: ' .$userProfileTitle);
		});
   		   		
   		$createUser = User::create([
            'name' => $data['name'],
            //'email' => $data['email'],
            'phone' => $data['name'],
            'password' => bcrypt($data['password']),
            'profile' => $data['profile'],
        ]);
 	
		$userProfileModel::create(['user_id' => $createUser->id]);  // добавление профиля в базу
        
        return $createUser;
    }
}
