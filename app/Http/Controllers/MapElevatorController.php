<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
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
    	$filterByCorn = null; // фильтр пока пустой
    	$filterByPriceMin = null; // фильтр по прайсу мин пока пустой
    	$filterByPriceMax = null; // фильтр по прайсу макс пока пустой
		$fav = substr($request->path(), -3) == 'fav' ? 1 : 0;
		
		if(Auth::check() == false & $fav){
	       return view('layouts.sysmessage')->with('message', 'Для просмотра избранных элеваторов Вам необходимо <a href="/login">авторизоваться</a> или <a href="/register">зарегистрироваться</a>');
	    }  	   	

    	if ( $request->has('filter') ) { // проверка на кнопку фильтра
			
			$elevators = $this->elevator
				->filterByState( $request->get('filterByState') ) //фильтруем данные по области
				->filterByRegion(  $request->get('filterByRegion') ); //фильтруем данные по району
			$filterByState = $request->get('filterByState');
			$filterByRegion = $request->get('filterByRegion');
		}
			
       
       	return view('elevator.index')->with([        
			// viewdata выбор из модели по авторизироанному пользователю
			'viewdata' => $elevators->favUserElevators(Auth::id(), $fav)->with(['town'])->orderBy('elevators.price','desc')->orderBy('towns.region_id','asc')->paginate(10),
			'corns' => $this->corn->all(),	
			'fav' => $fav,	
			'filter' => $request->has('filter') ? 'filter' : '',	
			'selected_corns' => $request->get('arrcorns'),	
			'filterByCorn' => $filterByCorn,
			'filterByPriceMin' => $filterByPriceMin,
			'filterByPriceMax' => $filterByPriceMax,
			'filterByState' => $filterByState,
			'filterByRegion' => $filterByRegion,
			'states' => $filterByState ? $this->state->where('id', $filterByState)->first() : $this->state->all(),
			'regions' => $filterByRegion ? $this->region->where('id', $filterByRegion)->first() : $this->region->where('state_id', $filterByState)->get(),			
		]);
    }
}
