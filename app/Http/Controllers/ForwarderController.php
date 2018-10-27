<?php

namespace App\Http\Controllers;

use App\Forwarder;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;

class ForwarderController extends Controller
{
	public function __construct(Forwarder $forwarder, User $user)
	{
		$this->forwarder = $forwarder;
		$this->user = $user;
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Forwarder  $forwarder
     * @return \Illuminate\Http\Response
     */
    public function show(Forwarder $forwarder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Forwarder  $forwarder
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         return view('forwarder.edit')->with([
			'viewdata' => $this->forwarder->find($id),
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Forwarder  $forwarder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Forwarder $forwarder)
    {
        $this->validator( $request->all() );
    	
    	$validatedData = $request->validate([
	        'newPassword' => 'confirmed',
	    ]);
	    
		$forwarder = $this->forwarder->find($id);		
		$forwarder->update($request->all());
		
		$forwarder->user->whatsapp = $request->whatsapp;
		$forwarder->user->telegram = $request->telegram;
		$forwarder->user->name = $request->name;
		$forwarder->user->phone = $request->phone;
		$forwarder->user->email = $request->email;
		
		if( $request->newPassword ){
			$forwarder->user->password = \Hash::make($request->newPassword);
		}
		
		$forwarder->user->save();
		$forwarder->save();		
		
		return redirect(route('order.index'))->with('message',"Информация по экспедитору $forwarder->title изменена");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Forwarder  $forwarder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Forwarder $forwarder)
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
