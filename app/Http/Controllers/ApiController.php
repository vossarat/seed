<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

use App\Elevator;
use App\User;

class ApiController extends Controller
{
	public function __construct(Elevator $elevator, User $user)
	{
		$this->elevator = $elevator;
		$this->user = $user;
	}
	
    public function favorite($action = 'remove', $user_id, $elevator_id)
    {
    	if( $action == 'add' ){
			$inserted = DB::table('favorite_user_elevator')->insert(
			    ['user_id' => $user_id, 'elevator_id' => $elevator_id]
			);	
		} else { // $action == 'remove'
			$deleted = DB::table('favorite_user_elevator')
				->where( 'user_id', $user_id )
				->where( 'elevator_id',$elevator_id )
					->delete();
		}
    }
    
    public function orderToElevator($action = 'remove', $order_id, $elevator_id)
    {
    	if( $action == 'add' ){
			$inserted = DB::table('order_elevator')->insert(
			    ['order_id' => $order_id, 'elevator_id' => $elevator_id]
			);	
		} else { // $action == 'remove'
			$deleted = DB::table('order_elevator')
				->where( 'order_id', $order_id )
				->where( 'elevator_id',$elevator_id )
					->delete();
		}
    }
    
    public function addViewOrder($order_id)
    {
    	DB::table('orders')->where('id', $order_id)->increment('views');
    	$cnt = DB::table('orders')->select()->where('id', $order_id)->first();
		return "&nbsp;".$cnt->views;
    }
    
    public function closedOrder($order_id)
    {
    	DB::table('orders')->where('id', $order_id)->update(['active' => 0]);
    }
    
    // значение гостов по культуре
    public function getGostsbyCorn($idCorn)
    {
    	$gosts = DB::table('corn_gost')->where('corn_id', $idCorn)->get();
    	$corn_gost = [];
    	if(isset($gosts)){
			foreach($gosts as $item){
				$corn_gost[] = $item->gost_id;
			}
		}
    	return $corn_gost;
    }    
    
}
