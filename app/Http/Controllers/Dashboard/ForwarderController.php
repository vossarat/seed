<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
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
        return view('dashboard.forwarder.index')->with([
                'viewdata' => $this->forwarder->orderBy('title')->get(),
            ]);
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
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        return view('dashboard.forwarder.edit')->with([
                'viewdata' => $this->forwarder->find($id),
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

        $forwarder = $this->forwarder->find($id);

        $forwarder->update($request->all());

        $forwarder->user->email = $request->email;
        $forwarder->user->phone = $request->phone;
        $forwarder->user->whatsapp = $request->whatsapp;
        $forwarder->user->telegram = $request->telegram;

        if ( $request->newPassword ) {
            $forwarder->user->password = \Hash::make($request->newPassword);
        }
        $forwarder->user->save();
        $forwarder->save();

        return redirect(route('dashboard_forwarder.index'))->with('message',"Информация по экспедитору $forwarder->title изменена");
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
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
