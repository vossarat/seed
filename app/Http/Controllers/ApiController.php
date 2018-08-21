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
    
    
}
