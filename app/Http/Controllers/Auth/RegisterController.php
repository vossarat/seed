<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

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
	    return route("$route.create");
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
	            /*'email.required' => 'укажите Ваш e-mail',
	            'email.email' => 'e-mail некоректен',
	            'email.unique' => 'Пользователь с таким e-mail уже зарегистрирован',*/
	            
	            'name.required' => 'укажите Имя пользователя',
	            'name.unique' => 'Пользователь с таким именем уже зарегистрирован',
	            
	            'password.min' => 'Пароль должен содержать не менее 6 символов',
	            'password.confirmed' => 'Неправильное подтверждение пароля',
	            'password.required' => 'Заполните пароль',
	            'password' => 'required|string|min:6|confirmed',
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
        return User::create([
            'name' => $data['name'],
            //'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'profile' => $data['profile'],
        ]);
    }
}
