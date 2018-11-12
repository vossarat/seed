<?php

namespace App\Http\Controllers;

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
		$this->region = $region;
		$this->state = $state;
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
			'states' => $this->state->orderBy('name','asc')->get(),
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
		
		// Удаление других профилей если есть
		$deletedTrader = Trader::where('user_id', Auth::user()->id )->delete();
		$deletedForwarder = Forwarder::where('user_id', Auth::user()->id )->delete();

		return redirect(route('order.index'))->with([
			'message' => "Информация по производителю СХП $request->title добавлена",
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
     * @param  \App\Farmer  $farmer
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
		
		return redirect(route('order.index'))->with('message',"Информация по производителю СХП $farmer->title изменена");
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
