<?php

namespace App\Http\Controllers;

use App\Trader;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        $trader = Trader::create($request->all());

		$trader->user->update($request->all());		
		$trader->user->save();

		return redirect(route('trader.index'))->with([
			'message' => "Информация по трейдеру $request->name добавлена",
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
    	$validatedData = $request->validate([
	        'newPassword' => 'confirmed',
	    ]);
	    
		$trader = $this->trader->find($id);		
		$trader->update($request->all());
		
		//$trader->user->update($request->all()); // сохраняем в user сразу все поля		
		$trader->user->whatsapp = $request->whatsapp;
		$trader->user->telegram = $request->telegram;			
		$trader->user->password = \Hash::make($request->newPassword);
		
		$trader->user->save();
		$trader->save();		
		
		return redirect(route('trader.index'))->with('message',"Информация по трейдеру $trader->name изменена");
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
}
