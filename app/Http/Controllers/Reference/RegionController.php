<?php

namespace App\Http\Controllers\Reference;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Reference\Region;
use App\Reference\State;

class RegionController extends Controller
{
	public function __construct(Region $region, State $state)
	{
		$this->region = $region;
		$this->state = $state;
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       	return view('dashboard.territory.region.index')->with([        
			'viewdata' => $this->region->all(),
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$viewdata = $this->region->find(0);
        return view('dashboard.territory.region.create')->with([
			'viewdata' => $viewdata,
			'states' => $this->state->all(),
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
        $region = Region::create($request->all());
	
		return redirect(route('region.index'))->with([
			'message' => "Информация по району $request->name добавлена",
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
        $region = $this->region->find($id);
    	
        return view('dashboard.territory.region.edit')->with([
			'viewdata' => $region,
			'states' => $this->state->all(),
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
        $region = $this->region->find($id);
		$region->update($request->all());	
		$region->save();
		return redirect(route('region.index'))->with('message',"Информация по району $region->name изменена");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $region = $this->region->find($id);
        
		$region->delete();
		return back()->with('message',"Район $region->name удалена");
    }
}
