<?php

namespace App\Http\Controllers;

use App\Trader;
use App\Farmer;
use App\Forwarder;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
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
        return view('forwarder.create')->with([
			'viewdata' => new Forwarder,
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
            	
        $forwarder = forwarder::create($request->all());

		$forwarder->user->update($request->all());		
		$forwarder->user->profile = 'forwarder';
		$forwarder->user->name = $request->name ;
		$forwarder->user->save();
		
		// Удаление других профилей если есть
		$deletedFarmer = Farmer::where('user_id', Auth::user()->id )->delete();
		$deletedTrader = Trader::where('user_id', Auth::user()->id )->delete();
		
		return redirect(route('order.index'))->with([
			'message' => "Информация по трейдеру $request->title добавлена",
		]);
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
    public function update(Request $request, $id)
    {   
    	$this->validator( $request->all() );
    	
		$forwarder = $this->forwarder->find($id);		
				
		$forwarder->update($request->all());
		
		$forwarder->user->whatsapp = $request->whatsapp;
		$forwarder->user->telegram = $request->telegram;

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
                'phone' => ['required', Rule::unique('users')->ignore($data['user_id'])],
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
