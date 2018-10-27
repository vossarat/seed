<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Trader;
use App\Farmer;
use Illuminate\Support\Facades\Validator;
use Auth;

class TraderController extends Controller
{
	public function __construct(Trader $trader)
	{
		$this->trader = $trader;
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.trader.index')->with([        
			'viewdata' => $this->trader->orderBy('title')->get(),
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	// отключил добавление трейдера
        //return view('dashboard.trader.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	// отключил добавление трейдера
        /*$this->validator( $request->all() );
    	
        $trader = Trader::create($request->all());

		$trader->user->update($request->all());		
		$trader->user->profile = 'trader';
		$trader->user->name = $request->name ;
		$trader->user->save();
		
		// Удаление профиля фермера если есть, так как профиль может быть только один 
		if($request->id) {
			$deletedFarmer = Farmer::where('user_id', $request->id )->delete();
		}
		
		
		return redirect(route('dashboard_trader.index'))->with([
			'message' => "Информация по трейдеру $request->title добавлена",
		]);*/
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
    	
        return view('dashboard.trader.edit')->with([
			'viewdata' => $this->trader->find($id),
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
    	
    	/*$validatedData = $request->validate([
	        'newPassword' => 'confirmed',
	    ]);*/
	    
    
		$trader = $this->trader->find($id);		
		$trader->update($request->all());
		
		//$trader->user->update($request->all()); // сохраняем в user сразу все поля		
		$trader->user->whatsapp = $request->whatsapp;
		$trader->user->telegram = $request->telegram;
		$trader->user->name = $request->phone;
		$trader->user->phone = $request->phone;
		$trader->user->email = $request->email;
		
		if( $request->newPassword ){
			$trader->user->password = \Hash::make($request->newPassword);
		}
		
		$trader->user->save();
		$trader->save();		

		//return redirect(route('trader.index'))->with('message',"Информация по трейдеру $trader->title изменена");
		return redirect(route('dashboard_trader.index'))->with('message',"Информация по трейдеру $trader->title изменена");
		
        
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
    	$id =  isset($data['id']) ? $data['id'] : '';
        return Validator::make($data, 
        	[
	        	'phone' => 'required|unique:users,phone,' . $id,
            ],            
            [           
	            'phone.required' => 'укажите номер телефона',           
	            'phone.unique' => 'данный номер телефона зарегистрирован',     
            ]
        )->validate();
    }
}
