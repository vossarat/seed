<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Trader;
use App\Farmer;
use App\Forwarder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
	public function __construct(User $user)
	{
		$this->user = $user;
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$orderBy = 'name';
    	if( $request->has('order') ) {
			$orderBy = $request->order;
		}
		
        return view('dashboard.user.index')->with([        
			'viewdata' => $this->user->orderBy($orderBy)->get(),
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	
        return view('dashboard.user.create')->with([
			'disabled' => '',
			'viewdata' => new User(),
		]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$this->validator( $request->all() );
    
        $requestArray = $request->all();
        $requestArray['name'] = $request->phone;
        $requestAddPass = array_add($requestArray, 'password', bcrypt($request->newPassword));
        
        $createUser = User::create($requestAddPass);
        
        if( $request->profile == 'farmer' ){
			$createFarmer = Farmer::create(['user_id' => $createUser->id]); // добавление профиля фермера
			$deletedTrader = Trader::where('user_id', $createUser->id )->delete(); // Удаление профиля трейдера если есть что не было и так и так
		} else {
			$createTrader = Trader::create(['user_id' => $createUser->id]); // добавление профиля трейдера
			$deletedFarmer = Farmer::where('user_id', $createUser->id )->delete(); // Удаление профиля фермера если есть что не было и так и так
		}  

		return redirect(route('dashboard_user.index'))->with([
			'message' => "Информация по пользователю $request->name добавлена",
		]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('dashboard.user.show')->with([
			'viewdata' => $this->user->find($id),
			'disabled' => 'disabled',
		]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->user->find($id);
			
        return view('dashboard.user.edit')->with([
			'viewdata' => $user,
			'disabled' => '',
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	$this->validator( $request->all() );
    	
		$user = $this->user->find($id);
		
		if( $request->profile == 'farmer' && $user->profile != 'farmer' ){
			$createFarmer = Farmer::create(['user_id' => $user->id]); // добавление профиля фермера
			$deletedTrader = Trader::where('user_id', $user->id )->delete(); // Удаление профиля трейдера если есть 
			$deletedForwarder = Forwarder::where('user_id', $user->id )->delete(); // Удаление профиля экспедитора если есть
		}
		
		if( $request->profile == 'trader' && $user->profile != 'trader' ){
			$createTrader = Trader::create(['user_id' => $user->id]); // добавление профиля трейдера
			$deletedFarmer = Farmer::where('user_id', $user->id )->delete(); // Удаление профиля фермера если есть
			$deletedForwarder = Forwarder::where('user_id', $user->id )->delete(); // Удаление профиля экспедитора если есть 
		}
		
		if( $request->profile == 'forwarder' && $user->profile != 'forwarder' ){
			$createForwarder = Forwarder::create(['user_id' => $user->id]); // добавление профиля экспедитора
			$deletedFarmer = Farmer::where('user_id', $user->id )->delete(); // Удаление профиля фермера если есть
			$deletedTrader = Trader::where('user_id', $user->id )->delete(); // Удаление профиля трейдера если есть
		} 		
	
		$user->update($request->all());
	
		if( $request->newPassword ){
			$user->password = \Hash::make($request->newPassword);
		}
				 
		$user->save();		
		
		if($request->sms) {
			$message = "Портал www.zelenka.trade/help Имя:$request->name Пароль:$request->newPassword";
			$phone = preg_replace("/[^,.0-9]/", '', $request->phone);
			
			$smsRes = file_get_contents('http://smsc.kz/sys/send.php?login=Zelenka.kz&psw=espresso18return&phones='.$phone.'&mes='.$message.'&charset=utf-8&sender');
		}
	
		return redirect(route('dashboard_user.index'))->with('message',"Информация по пользователю $user->name изменена");
	    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*$user = $this->user->find($id);
    	
		$user->delete();
		return back()->with('message',"Информация по $user->name удалена");*/
    }
    
    protected function validator(array $data)
    {
    	
        return Validator::make($data,
            [
                'phone' => ['required', Rule::unique('users')->ignore($data['id'])],
                'newPassword' => 'confirmed',
                'email' => 'email|nullable',
            ],
            [
                'phone.required' => 'укажите номер телефона',
                'phone.unique' => 'данный номер телефона зарегистрирован',
                'newPassword.confirmed' => 'Неправильное подтверждение пароля',
                'email.email' => 'e-mail некорректен',
            ]
        )->validate();
    }
}
