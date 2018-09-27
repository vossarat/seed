<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use App\Elevator;
use App\Farmer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
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
use App\Reference\Gost;

class OrderController extends Controller
{
	public function __construct(Order $order, Corn $corn, Pack $pack, Loadprice $loadprice, Elevator $elevator, Region $region, State $state, Town $town, Point $point, User $user, Farmer $farmer, Gost $gost)
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
		$this->farmer = $farmer;
		$this->gost = $gost;
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
			'viewdata' => $orders->orderBy('id','desc')->paginate(10),
			'corns' => $this->corn->orderBy('name','asc')->get(),
			'packs' => $this->pack->orderBy('name','asc')->get(),
			'loadprices' => $this->loadprice->orderBy('name','asc')->get(),
			'elevators' => $this->elevator->orderBy('title','asc')->get(),
			'regions' => $this->region->orderBy('name','asc')->get(),
			'states' => $this->state->orderBy('name','asc')->get(),
			'towns' => $this->town->orderBy('name','asc')->get(),
			'points' => $this->point->orderBy('name','asc')->get(),			
			'gosts' => $this->gost->orderBy('name','asc')->get(),			
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
	    
	    if(Auth::user()->profile === 'farmer'){
	       return view('layouts.sysmessage')->with('message', 'Вы зарегистрированы как Фермер и не можете добавить заявку <a href="/order">назад</a>');
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
			'gosts' => $this->gost->orderBy('name','asc')->get(),
			'fav_elevators' => $this->elevator->fav( Auth::id() )->get(), // избранные элеваторы
			
			'elevator_order' => [],
			'gost_order' => [],
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
    	$this->validator( $request->all() );
    	
        $order = Order::create($request->all());
        
        $corn_name = $this->corn->find($request->corn_id)->name;
        
        $order->user->update($request->all());
        $order->elevators()->attach($request->elevators); // сохраняем информацию по элеваторам
        $order->gosts()->attach($request->gosts); // привязка к ГОСТ		
		$order->user->save();
		
		$farmerPhones = $this->farmer->farmersPhonesByCorn($request->corn_id) ;
        
        $message = 'Новая заявка на '.$corn_name;
        $smsRes = file_get_contents('http://smsc.kz/sys/send.php?login=Zelenka.kz&psw=espresso18return&phones='.implode(",", $farmerPhones).'&mes='.$message.'&charset=utf-8&sender');
       
        $farmerEmails = $this->farmer->farmersEmailsByCorn($request->corn_id) ;
		Mail::send('farmer.email', ['corn_name' => $corn_name], function ($message) use ($farmerEmails) {
		    $message->from('tarassov.dv@gmail.com', 'Администратор');
			$message->to($farmerEmails, '')->subject('Тестовое Сообщение с портала Zelenka.Trade');
		});
		
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
		
		$gost_order = [];
    	if(isset($order->gosts)){
			foreach($order->gosts->all() as $item){
				$gost_order[] = $item->id;
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
			'gosts' => $this->gost->orderBy('name','asc')->get(),
			'elevator_order' => $elevator_order,
			'gost_order' => $gost_order,
			'disabled' => '',
			'fav_elevators' => $this->elevator->fav( Auth::id() )->get(), // избранные элеваторы
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
    	//dd( $request->all() );
    	$this->validator( $request->all() );
    	
        $order = $this->order->find($id);
 	
    	if(Gate::denies('update', $order)){
		    return view('layouts.sysmessage')->with('message','Это на Ваша заявка. Вы не можете ее редактировать.');
		}
        		
		
		
		$order->update($request->all());
		
		$order->user->phone = $request->phone;
		$order->user->whatsapp = $request->whatsapp;
		$order->user->telegram = $request->telegram;
		
		$order->user->save();
		
		$order->elevators()->sync($request->elevators);
		$order->gosts()->sync($request->gosts); // привязка к ГОСТ		
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
    
    protected function validator(array $data)
    {
        return Validator::make($data, 
        	[
	        	'price' => 'required|max:255',
	        	'count' => 'required|max:255',
	        	'phone' => 'required',
	        	'email' => 'required|email',
            ],            
            [
           
	            'price.required' => 'укажите цену за тонну',
	            'count.required' => 'укажите количество в тоннах',
	            'phone.required' => 'Обязательное поле',
	        	'max' => 'Уменьшите количество символов',
	        	'email' => 'некорректный email',
            ]
        )->validate();
    }
}
