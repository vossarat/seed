<?php

namespace App\Http\Controllers;

use App\Farmer;
use App\User;
use App\Reference\Region;
use App\Reference\Corn;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
			'regions' => $this->region->all(),
			'corns' => $this->corn->all(),
			'farmer_corn' => [],
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
        $farmer = Farmer::create($request->all());

		$farmer->user->update($request->all());
			
		$farmer->corns()->attach($request->corns); // сохраняем информацию по приему культуры
		$farmer->user->save();

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
    	
        return view('farmer.edit')->with([
			'viewdata' => $this->farmer->find($id),
			'regions' => $this->region->all(),
			'corns' => $this->corn->all(),
			'farmer_corn' => $farmer_corn,
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
        $validatedData = $request->validate([
	        'newPassword' => 'confirmed',
	    ]);
	    
		$farmer = $this->farmer->find($id);		
		$farmer->update($request->all());
	
		$farmer->user->whatsapp = $request->whatsapp;
		$farmer->user->telegram = $request->telegram;			
		$farmer->user->password = \Hash::make($request->newPassword);
		
		$farmer->corns()->sync($request->corns); // сохраняем информацию по приему культуры	
		
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
}
