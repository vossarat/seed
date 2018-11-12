<?php

namespace App\Http\Controllers;

use App\Wagon;
use Illuminate\Http\Request;
use App\Order;
use App\User;
use App\Elevator;
use App\Farmer;
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
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class WagonController extends Controller
{
	public function __construct(Wagon $wagon, Corn $corn, Pack $pack, Elevator $elevator, User $user, Farmer $farmer, Region $region, State $state, Town $town, Point $point)
	{		
		$this->wagon = $wagon;
		$this->corn = $corn;
		$this->pack = $pack;
		$this->elevator = $elevator;
		$this->region = $region;
		$this->state = $state;
		$this->town = $town;
		$this->user = $user;
		$this->farmer = $farmer;
		$this->point = $point;
		$this->elevator = $elevator;
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $wagons = $this->wagon;
   	
    	if ( $request->has('filter') ) { // проверка на кнопку фильтра
			/*$wagons = $this->wagon
				->filterByCorn( $request->get('arrcorns') ) //фильтруем данные по культуре
				->filterByRegion( $request->get('filterByRegion') ) //фильтруем данные по району
				->filterByPriceMin( $request->get('filterByPriceMin') ) //фильтруем данные по прайсу
				->filterByPriceMax( $request->get('filterByPriceMax') ); //фильтруем данные по прайсу*/
		}
    	
        return view('wagon.index')->with([        
			'viewdata' => $wagons->orderBy('id','desc')->paginate(10),
			'corns' => $this->corn->orderBy('name','asc')->get(),
			'packs' => $this->pack->orderBy('name','asc')->get(),
			
			'elevators' => $this->elevator->orderBy('title','asc')->get(),
			'regions' => $this->region->orderBy('name','asc')->get(),
			'states' => $this->state->orderBy('name','asc')->get(),
			'towns' => $this->town->orderBy('name','asc')->get(),
			'points' => $this->point->orderBy('name','asc')->get(),			
			/*'gosts' => $this->gost->orderBy('name','asc')->get(),			
			'filter' => $request->has('filter') ? 'filter' : '',
			'selected_corns' => $request->get('arrcorns'),
			'filterByPriceMin' => $request->get('filterByPriceMin'),
			'filterByPriceMax' => $request->get('filterByPriceMax'),
			'filterByRegion' => $request->get('filterByRegion'),*/
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
	    
	    if(Auth::user()->profile != 'trader'){
	       return view('layouts.sysmessage')->with('message', 'Добавить заявку могут только пользователи с профилем "Трейдер" <a href="/wagon">назад</a>');
	    }
	    
        return view('wagon.create')->with([
			'viewdata' => Auth::user(),
			'corns' => $this->corn->orderBy('name','asc')->get(),
			'packs' => $this->pack->orderBy('name','asc')->get(),
			'elevators' => $this->elevator->orderBy('title','asc')->get(),
			'regions' => $this->region->orderBy('name','asc')->get(),
			'states' => $this->state->orderBy('name','asc')->get(),
			'towns' => $this->town->orderBy('name','asc')->get(),
			'points' => $this->point->orderBy('name','asc')->get(),				
			'fav_elevators' => [],			
			'elevator_wagon' => [],
			'newrecord' => '',

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
    	
        // модификация даты поставки и подключение модифицировованной даты к массиву 
		$date_delivery = new Carbon($request->date_delivery);		
		$request->merge([ 'date_delivery' => $date_delivery ]);
		
        $wagon = Wagon::create($request->all());
		
        $wagon->user->update($request->all());
		$wagon->user->save();
		
		return redirect(route('wagon.index'))->with([
			'message' => "Информация по заявке для экспедитора добавлена",
		]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Wagon  $wagon
     * @return \Illuminate\Http\Response
     */
    public function show(Wagon $wagon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Wagon  $wagon
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $wagon = $this->wagon->find($id); 	
 		
		
    	if(Gate::denies('update', $wagon)){
		    return view('layouts.sysmessage')->with('message','Это на Ваша заявка. Вы не можете ее редактировать.');
		}
			
        return view('wagon.edit')->with([
			'viewdata' => $wagon,
			'corns' => $this->corn->orderBy('name','asc')->get(),
			'packs' => $this->pack->orderBy('name','asc')->get(),
			
			'elevators' => $this->elevator->orderBy('title','asc')->get(),
			'regions' => $this->region->orderBy('name','asc')->get(),
			'states' => $this->state->orderBy('name','asc')->get(),
			'towns' => $this->town->orderBy('name','asc')->get(),
			'points' => $this->point->orderBy('name','asc')->get(),	
			'elevator_order' => [],
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Wagon  $wagon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	$this->validator( $request->all() );
    	
        $wagon = $this->wagon->find($id);
 	
    	if(Gate::denies('update', $wagon)){
		    return view('layouts.sysmessage')->with('message','Это на Ваша заявка. Вы не можете ее редактировать.');
		}    		
		
		// модификация даты поставки и подключение модифицировованной даты к массиву 
		$date_delivery = new Carbon($request->date_delivery);		
		$request->merge([ 'date_delivery' => $date_delivery ]);
		
		$wagon->update($request->all());
		
		$wagon->user->phone = $request->phone;
		$wagon->user->whatsapp = $request->whatsapp;
		$wagon->user->telegram = $request->telegram;
		
		$wagon->user->save();
		
		$wagon->save();
		return redirect(route('wagon.index'))->with('message',"Информация по заявке $wagon->title изменена");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Wagon  $wagon
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $wagon = $this->wagon->find($id);
    	
    	/*if(Gate::denies('delete', $order)){
		    return view('layouts.sysmessage')->with('message','Вы не можете удалить эту заявку.');
		}*/
		
		if(Auth::check() && Auth::user()->id == 1){
		    $wagon->delete();
			return back()->with('message',"Заявка $wagon->title удалена");
		} 
		else {
			 return view('layouts.sysmessage')->with('message','Вы не можете удалить эту заявку.');
		}
    }
    
    protected function validator(array $data)
    {
        return Validator::make($data, 
        	[
	        	'phone' => ['required', Rule::unique('users')->ignore($data['user_id'])],
	        	'email' => 'email|nullable',
	        	'date_delivery' => 'required|date_format:d/m/Y',
	        	'transport_tip' => 'required',
            ],            
            [           
	            'phone.required' => 'укажите номер телефона',
                'phone.unique' => 'данный номер телефона зарегистрирован',
                'email.email' => 'e-mail некорректен',
                'date_delivery.required' => 'укажите срок поставки',
                'transport_tip.required' => 'укажите тип транспорта',
                'date_delivery.date_format' => 'некорректная дата',
                
            ]
        )->validate();
    }
}
