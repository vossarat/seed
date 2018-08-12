<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Elevator;
use App\Reference\Region;
use App\Reference\State;
use App\Reference\Town;
use App\Reference\Corn;
use App\User;

class MapElevatorController extends Controller
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
    public function index(Request $request)
    {
    	$elevators = $this->elevator;
    	$filterByState = null; // фильтр пока пустой
    	$filterByRegion = null; // фильтр пока пустой
    	
    	if ( $request->has('filter') ) { // проверка на кнопку фильтра
			$filterByState = $request->get('filterByState');
			$filterByRegion = $request->get('filterByRegion');
			$elevators = $this->elevator
				->filterByState($filterByState) //фильтруем данные по области
				->filterByRegion($filterByRegion); //фильтруем данные по району
		}
       	
       	return view('elevator.index')->with([        
			'viewdata' => $elevators->orderBy('elevators.id','desc')->paginate(10),			
			'filterByState' => $filterByState,
			'filterByRegion' => $filterByRegion,
			'states' => $filterByState ? $this->state->where('id', $filterByState)->first() : $this->state->all(),
			'regions' => $filterByRegion ? $this->region->where('id', $filterByRegion)->first() : $this->region->where('state_id', $filterByState)->get(),			
		]);
    } 
}
