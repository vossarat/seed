<?php

namespace App\Http\Controllers;

use App\Elevator;
use Illuminate\Http\Request;
use App\Reference\Region;
use App\Reference\State;
use App\Reference\Town;
use App\Reference\Corn;
use App\User;
use Auth;

class ElevatorController extends Controller
{
	public function __construct(Elevator $elevator, Region $region, State $state, Town $town, Corn $corn, User $user)
	{
		$this->elevator = $elevator;
		$this->region = $region;
		$this->state = $state;
		$this->town = $town;
		$this->corn = $corn;
		$this->user = $user;
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       	return view('dashboard.elevator.index')->with([        
			'viewdata' => $this->elevator->all(),
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$viewdata = $this->elevator->find(0);
    	
        return view('dashboard.elevator.create')->with([
			'viewdata' => $viewdata,
			'states' => $this->state->all(),
			'regions' => $this->region->all(),
			'towns' => $this->town->all(),
			'corns' => $this->corn->all(),
			'elevator_corn' => [],
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
    	
        $elevator = elevator::create($request->all());
        
        $elevator->corns()->attach($request->corns); // сохраняем информацию по приему культуры
	
		return redirect(route('elevator.index'))->with([
			'message' => "Информация по элеватору $request->name добавлена",
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
        $elevator = $this->elevator->find($id);   	
    	
    	$elevator_corn = [];
    	if(isset($elevator->corns)){
			foreach($elevator->corns->all() as $item){
				$elevator_corn[] = $item->id;
			}
		}
    	
    	
        return view('dashboard.elevator.edit')->with([
			'viewdata' => $elevator,
			'states' => $this->state->all(),
			'regions' => $this->region->all(),
			'towns' => $this->town->all(),
			'corns' => $this->corn->all(),
			'elevator_corn' => $elevator_corn,
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
        $elevator = $this->elevator->find($id);
		$elevator->update($request->all());	
		$elevator->corns()->sync($request->corns); // сохраняем информацию по приему культуры
		$elevator->save();
		return redirect(route('elevator.index'))->with('message',"Информация по элеватору $elevator->name изменена");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $elevator = $this->elevator->find($id);
        
		$elevator->delete();
		return back()->with('message',"Элеватор $elevator->name удален");
    }
}
