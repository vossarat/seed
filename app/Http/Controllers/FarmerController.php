<?php

namespace App\Http\Controllers;

use App\Farmer;
use App\Trader;
use App\User;
use App\Reference\Region;
use App\Reference\Corn;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class FarmerController extends Controller
{
	public function __construct(Farmer $farmer, User $user, Region $region, Corn $corn)
	{
		$this->farmer = $farmer;
		$this->user = $user;
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('farmer.create')->with([
			'regions' => $this->region->orderBy('name','asc')->get(),
			'corns' => $this->corn->orderBy('name','asc')->get(),
			'farmer_corn' => [],
			'farmer_region' => [],
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
    	
        $farmer = Farmer::create($request->all());

		$farmer->user->update($request->all());
			
		$farmer->corns()->attach($request->corns); // сохраняем информацию по приему культуры
		$farmer->regions()->attach($request->regions); // сохраняем информацию по региону
		
		$farmer->user->profile = 'farmer';
		$farmer->user->save();
		
		// Удаление профиля трейдера
		$deletedTrader = Trader::where('user_id', Auth::user()->id )->delete();

		return redirect(route('order.index'))->with([
			'message' => "Информация по фермеру $request->title добавлена",
		]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Farmer  $farmer
     * @return \Illuminate\Http\Response
     */
    public function show(Farmer $farmer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Farmer  $farmer
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
    	
        return view('farmer.edit')->with([
			'viewdata' => $this->farmer->find($id),
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
     * @param  \App\Farmer  $farmer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	$this->validator( $request->all() );
    	
        $validatedData = $request->validate([
	        'newPassword' => 'confirmed',
	    ]);
	    
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
		
		return redirect(route('order.index'))->with('message',"Информация по фермеру $farmer->title изменена");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Farmer  $farmer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Farmer $farmer)
    {
        //
    }
    
    protected function validator(array $data)
    {
        return Validator::make($data, 
        	[
	        	'name' => 'required|max:255',
	        	'phone' => 'required',
	        	'email' => 'email|nullable',
	        	'fio' => 'required|max:255',
	        	//'regions' => 'required',
	        	'corns' => 'required',
            ],            
            [
           
	            'name.required' => 'укажите имя пользователя',
	            'phone.required' => 'укажите номер телефона',	           
	            'corns.required' => 'выберите культуру',	           
	            //'regions.required' => 'укажите район',	           
	            'fio.required' => 'укажите ФИО',	           
	        	'max' => 'уменьшите количество символов',
	        	'email.email' => 'e-mail некорректен',
            ]
        )->validate();
    }
}
