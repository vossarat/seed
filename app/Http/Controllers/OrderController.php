<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use App\Elevator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Gate;
use Mail;
use App\Reference\Corn;
use App\Reference\Pack;
use App\Reference\Loadprice;
use App\Reference\Region;
use App\Reference\State;
use App\Reference\Town;
use App\Reference\Point;

class OrderController extends Controller
{
	public function __construct(Order $order, Corn $corn, Pack $pack, Loadprice $loadprice, Elevator $elevator, Region $region, State $state, Town $town, Point $point, User $user)
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
		$this->user = $user;
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$orders = $this->order;
   	
    	if ( $request->has('filter') ) { // проверка на кнопку фильтра
			$orders = $this->order
				->filterByCorn( $request->get('arrcorns') ) //фильтруем данные по культуре
				->filterByRegion( $request->get('filterByRegion') ) //фильтруем данные по району
				->filterByPriceMin( $request->get('filterByPriceMin') ) //фильтруем данные по прайсу
				->filterByPriceMax( $request->get('filterByPriceMax') ); //фильтруем данные по прайсу
		}
    	
        return view('order.index')->with([        
			'viewdata' => $orders->orderBy('id','desc')->paginate(5),
			'corns' => $this->corn->orderBy('name','asc')->get(),
			'packs' => $this->pack->orderBy('name','asc')->get(),
			'loadprices' => $this->loadprice->orderBy('name','asc')->get(),
			'elevators' => $this->elevator->orderBy('title','asc')->get(),
			'regions' => $this->region->orderBy('name','asc')->get(),
			'states' => $this->state->orderBy('name','asc')->get(),
			'towns' => $this->town->orderBy('name','asc')->get(),
			'points' => $this->point->orderBy('name','asc')->get(),			
			'filter' => $request->has('filter') ? 'filter' : '',
			'selected_corns' => $request->get('arrcorns'),
			'filterByPriceMin' => $request->get('filterByPriceMin'),
			'filterByPriceMax' => $request->get('filterByPriceMax'),
			'filterByRegion' => $request->get('filterByRegion'),
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
			'corns' => $this->corn->orderBy('name','asc')->get(),
			'packs' => $this->pack->orderBy('name','asc')->get(),
			'loadprices' => $this->loadprice->orderBy('name','asc')->get(),
			'elevators' => $this->elevator->orderBy('title','asc')->get(),
			'regions' => $this->region->orderBy('name','asc')->get(),
			'states' => $this->state->orderBy('name','asc')->get(),
			'towns' => $this->town->orderBy('name','asc')->get(),
			'points' => $this->point->orderBy('name','asc')->get(),
			'elevator_order' => [],
			'disabled' => '',
			'neworder' => true,
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
        /*Mail::send('order.index', ,
            function ($message) use ($user)
            {
                $message->from('d.tarassov@akmzdrav.kz', 'Sender');
                $message->to('')->subject('Test message');
            });*/
            
        /*$data = array('name'=>"Virat Gandhi");
  
	     Mail::send(['text'=>'welcome'], $data, function($message) {
	        $message->to('d.tarassov@akmzdrav.kz', 'Tutorials Point')->subject
	           ('Laravel Basic Testing Mail');
	        $message->from('xyz@gmail.com','Virat Gandhi');
	     });*/
	     
		/*Mail::raw('Text', function ($message){
			$message->to('d.tarassov@akmzdrav.kz');
		});
        
    	dd( 'Send Message' );*/
    	
    	
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
    	$selected_elevator_order = DB::table('order_elevator')
 			->select('elevator_id')
 			->where('order_id', $order->id)->get();
    	
    	if(isset($selected_elevator_order)){
			foreach($selected_elevator_order->all() as $item){
				$elevator_order[] = $item->elevator_id;
			}
		}	
		
		return view('order.show')->with([
			'viewdata' => $this->order->find($id),
			'corns' => $this->corn->orderBy('name','asc')->get(),
			'packs' => $this->pack->orderBy('name','asc')->get(),
			'loadprices' => $this->loadprice->orderBy('name','asc')->get(),
			'elevators' => $this->elevator->orderBy('title','asc')->get(),
			'regions' => $this->region->orderBy('name','asc')->get(),
			'states' => $this->state->orderBy('name','asc')->get(),
			'towns' => $this->town->orderBy('name','asc')->get(),
			'points' => $this->point->orderBy('name','asc')->get(),
			'disabled' => 'disabled',
			'elevator_order' => $elevator_order,
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
   	
 		$selected_elevator_order = DB::table('order_elevator')
 			->select('elevator_id')
 			->where('order_id', $order->id)->get();
    	
    	$elevator_order = [];
    	if(isset($selected_elevator_order)){
			foreach($selected_elevator_order->all() as $item){
				$elevator_order[] = $item->elevator_id;
			}
		}	
   	
    	if(Gate::denies('update', $order)){
		    return view('layouts.sysmessage')->with('message','Это на Ваша заявка. Вы не можете ее редактировать.');
		}
			
        return view('order.edit')->with([
			'viewdata' => $order,
			'corns' => $this->corn->orderBy('name','asc')->get(),
			'packs' => $this->pack->orderBy('name','asc')->get(),
			'loadprices' => $this->loadprice->orderBy('name','asc')->get(),
			'elevators' => $this->elevator->orderBy('title','asc')->get(),
			'regions' => $this->region->orderBy('name','asc')->get(),
			'states' => $this->state->orderBy('name','asc')->get(),
			'towns' => $this->town->orderBy('name','asc')->get(),
			'points' => $this->point->orderBy('name','asc')->get(),
			'elevator_order' => $elevator_order,
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
        $order = $this->order->find($id);
 	
    	if(Gate::denies('update', $order)){
		    return view('layouts.sysmessage')->with('message','Это на Ваша заявка. Вы не можете ее редактировать.');
		}
        		
		$order->update($request->all());
		
		$order->user->phone = $request->phone;
		$order->user->whatsapp = $request->whatsapp;
		$order->user->telegram = $request->telegram;
		
		$order->user->save();
		
		//$order->elevators()->sync($request->elevators);
		
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
