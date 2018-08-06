<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use App\Elevator;
use Illuminate\Http\Request;
use Auth;
use Gate;
use App\Reference\Corn;
use App\Reference\Pack;
use App\Reference\Loadprice;
use App\Reference\Region;
use App\Reference\State;
use App\Reference\Town;
use App\Reference\Point;

class OrderController extends Controller
{
	public function __construct(Order $order, Corn $corn, Pack $pack, Loadprice $loadprice, Elevator $elevator, Region $region, State $state, Town $town, Point $point)
	{		
		$this->order = $order;
		$this->corn = $corn;
		$this->pack = $pack;
		$this->loadprice = $loadprice;
		$this->elevator = $elevator;
		$this->region = $region;
		$this->state = $state;
		$this->town = $town;
		$this->point = $point;
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$orders = $this->order;
    	$filterByTitle = null; // фильтра по наименованию заявки, пока пустой
    	
    	if ( $request->has('filter') ) { // проверка на кнопку фильтра
			$filterByTitle = $request->get('filterByTitle');
			$orders = $this->order->filterByTitle($filterByTitle); //фильтруем данные
		}
    	
        return view('order.index')->with([        
			'viewdata' => $orders->orderBy('id','desc')->paginate(5),
			'corns' => $this->corn->all(),
			'packs' => $this->pack->all(),
			'loadprices' => $this->loadprice->all(),
			'elevators' => $this->elevator->all(),
			'regions' => $this->region->all(),
			'states' => $this->state->all(),
			'towns' => $this->town->all(),
			'points' => $this->point->all(),
			'filterByTitle' => $filterByTitle,
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	if(Auth::check() == false){
	       return view('layouts.sysmessage')->with('message', 'Для добавления заявки Вам необходимо <a href="/login">авторизоваться</a> или <a href="/register">зарегистрироваться</a>');
	    }
	    
        return view('order.create')->with([
			'viewdata' => Auth::user(),
			'corns' => $this->corn->all(),
			'packs' => $this->pack->all(),
			'loadprices' => $this->loadprice->all(),
			'elevators' => $this->elevator->all(),
			'regions' => $this->region->all(),
			'states' => $this->state->all(),
			'towns' => $this->town->all(),
			'points' => $this->point->all(),
			'disabled' => '',
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
    	//dd($request->all());
        $order = Order::create($request->all());
        
        $order->user->update($request->all());		
		$order->user->save();
		
		return redirect(route('order.index'))->with([
			'message' => "Информация по заявке $request->name добавлена",
		]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		return view('order.show')->with([
			'viewdata' => $this->order->find($id),
			'corns' => $this->corn->all(),
			'packs' => $this->pack->all(),
			'loadprices' => $this->loadprice->all(),
			'elevators' => $this->elevator->all(),
			'regions' => $this->region->all(),
			'states' => $this->state->all(),
			'towns' => $this->town->all(),
			'points' => $this->point->all(),
			'disabled' => 'disabled',
		]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 	
    	$order = $this->order->find($id);
    	
    	$order_elevator = [];
    	if(isset($order->elevators)){
			foreach($order->elevators->all() as $item){
				$order_elevator[] = $item->id;
			}
		}
    	
    	if(Gate::denies('update', $order)){
		    return view('layouts.sysmessage')->with('message','Это на Ваша заявка. Вы не можете ее редактировать.');
		}
			
        return view('order.edit')->with([
			'viewdata' => $order,
			'corns' => $this->corn->all(),
			'packs' => $this->pack->all(),
			'loadprices' => $this->loadprice->all(),
			'elevators' => $this->elevator->all(),
			'regions' => $this->region->all(),
			'states' => $this->state->all(),
			'towns' => $this->town->all(),
			'points' => $this->point->all(),
			'disabled' => '',
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	dd($request->all());
        $order = $this->order->find($id);
 	
    	if(Gate::denies('update', $order)){
		    return view('layouts.sysmessage')->with('message','Это на Ваша заявка. Вы не можете ее редактировать.');
		}
        		
		$order->update($request->all());
		
		$order->user->phone = $request->phone;
		$order->user->whatsapp = $request->whatsapp;
		$order->user->telegram = $request->telegram;
		
		$order->user->save();
		$order->save();
		return redirect(route('order.index'))->with('message',"Информация по заявке $order->title изменена");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = $this->order->find($id);
    	
    	if(Gate::denies('delete', $order)){
		    return view('layouts.sysmessage')->with('message','Вы не можете удалить эту заявку.');
		}
        
		$order->delete();
		return back()->with('message',"Заявка $order->title удалена");
    }
}
