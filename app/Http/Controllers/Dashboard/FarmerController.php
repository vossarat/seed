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
use Auth;
use App\Reference\State;
use App\Reference\Region;
use App\Reference\Corn;
use Illuminate\Validation\Rule;

class FarmerController extends Controller
{
	public function __construct(Farmer $farmer, User $user, State $state, Region $region, Corn $corn)
	{
		$this->farmer = $farmer;
		$this->user = $user;
		$this->state = $state;
		$this->region = $region;
		$this->corn = $corn;
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.farmer.index')->with([        
			'viewdata' => $this->farmer->orderBy('title')->get(),
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
    	
        $farmer = $this->farmer->find($id); 

    	$farmer_corn = [];
    	if(isset($farmer->corns)){
			foreach($farmer->corns->all() as $item){
				$farmer_corn[] = $item->id;
			}
		}
		
		$farmer_region = [];

    	if(isset($farmer->regions)){
			foreach($farmer->regions->all() as $item){
				$farmer_region[] = $item->id;
			}
		}	
    	
        return view('dashboard.farmer.edit')->with([
			'viewdata' => $this->farmer->find($id),
			'states' => $this->state->orderBy('name','asc')->get(),
			'regions' => $this->region->orderBy('name','asc')->get(),
			'corns' => $this->corn->orderBy('name','asc')->get(),
			'farmer_corn' => $farmer_corn,
			'farmer_region' => $farmer_region,
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
	    
		$farmer = $this->farmer->find($id);		
		$farmer->update($request->all());
	
		$farmer->user->email = $request->email;
		$farmer->user->phone = $request->phone;
		$farmer->user->whatsapp = $request->whatsapp;
		$farmer->user->telegram = $request->telegram;			
		
		if( $request->newPassword ){
			$farmer->user->password = \Hash::make($request->newPassword);
		}		 
		
		$farmer->corns()->sync($request->corns); // сохраняем информацию по приему культуры	
		$farmer->regions()->sync($request->regions); // сохраняем информацию по региону
		
		$farmer->user->save();
		$farmer->save();
		
		return redirect(route('dashboard_trader.index'))->with('message',"Информация по трейдеру $farmer->title изменена");
		
        
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
                'corns' => 'required',
                'email' => 'email|nullable',

            ],
            [
                'phone.required' => 'укажите номер телефона',
                'phone.unique' => 'данный номер телефона зарегистрирован',
                'newPassword.confirmed' => 'Неправильное подтверждение пароля',
                'corns.required' => 'выберите культуру',
                'email.email' => 'e-mail некорректен',
            ]
        )->validate();
    }
}
