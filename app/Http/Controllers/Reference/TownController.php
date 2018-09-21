<?php

namespace App\Http\Controllers\Reference;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Reference\Region;
use App\Reference\State;
use App\Reference\Town;

class TownController extends Controller
{
	public function __construct(Region $region, State $state, Town $town)
	{
		$this->region = $region;
		$this->state = $state;
		$this->town = $town;
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       	return view('dashboard.territory.town.index')->with([        
			'viewdata' => $this->town->all(),
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$viewdata = $this->town->find(0);
        return view('dashboard.territory.town.create')->with([
			'viewdata' => $viewdata,
			'states' => $this->state->all(),
			'regions' => $this->region->all(),
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
        $region = Town::create($request->all());
	
		return redirect(route('town.index'))->with([
			'message' => "Информация по населенному пункту $request->name добавлена",
		]);
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
        $town = $this->town->find($id);
    	
        return view('dashboard.territory.town.edit')->with([
			'viewdata' => $town,
			'states' => $this->state->all(),
			'regions' => $this->region->all(),
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
        $town = $this->town->find($id);
		$town->update($request->all());	
		$town->save();
		return redirect(route('town.index'))->with('message',"Информация по городу $town->name изменена");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $town = $this->town->find($id);
        
		$town->delete();
		return back()->with('message',"Город $town->name удален");
    }
}
