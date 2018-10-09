<?php

namespace App\Http\Controllers;

use App\Trader;
use App\Farmer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;


class TraderController extends Controller
{
	public function __construct(Trader $trader, User $user)
	{
		$this->trader = $trader;
		$this->user = $user;
	}
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('trader.index')->with([        
			'viewdata' => $this->trader->all(),
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trader.create');
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
    	
        $trader = Trader::create($request->all());

		$trader->user->update($request->all());		
		$trader->user->profile = 'trader';
		$trader->user->name = $request->name ;
		$trader->user->save();
		
		// Удаление профиля фермера
		$deletedFarmer = Farmer::where('user_id', Auth::user()->id )->delete();
		
		return redirect(route('order.index'))->with([
			'message' => "Информация по трейдеру $request->title добавлена",
		]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Trader  $trader
     * @return \Illuminate\Http\Response
     */
    public function show(Trader $trader)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trader  $trader
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('trader.edit')->with([
			'viewdata' => $this->trader->find($id),
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trader  $trader
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	$this->validator( $request->all() );
    	
    	$validatedData = $request->validate([
	        'newPassword' => 'confirmed',
	    ]);
	    
		$trader = $this->trader->find($id);		
		$trader->update($request->all());
		
		//$trader->user->update($request->all()); // сохраняем в user сразу все поля		
		$trader->user->whatsapp = $request->whatsapp;
		$trader->user->telegram = $request->telegram;
		$trader->user->name = $request->name;
		$trader->user->phone = $request->phone;
		$trader->user->email = $request->email;
		
		if( $request->newPassword ){
			$trader->user->password = \Hash::make($request->newPassword);
		}
		
		$trader->user->save();
		$trader->save();		
		
		return redirect(route('order.index'))->with('message',"Информация по трейдеру $trader->title изменена");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trader  $trader
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trader $trader)
    {
        //
    }
    
    protected function validator(array $data)
    {   

        return Validator::make($data, 
        	[
	        	'name' => 'required|max:255|unique:users,name,' . auth()->user()->id ,
	        	'phone' => 'required' ,
	        	'email' => 'required|email' ,
	        	
            ],            
            [
           
	            'name.required' => 'укажите имя пользователя',
	            'email.required' => 'укажите Ваш email',
	            'phone.required' => 'укажите номер телефона',
	        	'max' => 'уменьшите количество символов',
	        	'email' => 'некорректный email',
	        	'name.unique' => 'Пользователь с таким именем зарегистрирован',
	        	'phone.unique' => 'Пользователь с таким телефоном зарегистрирован',
	        	'email.unique' => 'Пользователь с таким email зарегистрирован',
            ]
        )->validate();
    }
}
