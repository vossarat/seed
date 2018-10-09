<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mail;

class FeedbackController extends Controller
{
    public function send(Request $request)
    {
    	//$this->validator( $request->all() ); 
    	
    	$viewdata = $request->all();
    	Mail::send('feedback.email', ['viewdata' =>  $viewdata], function ($message) use ($viewdata) {
		    $message->from('admin@zelenka.trade', 'Форма обратная связь ZELENKA.TRADE');
			$message->to('tarassov.dv@gmail.com', '')->subject('Сообщение от пользователя ' . $viewdata['name']);
		});
    	       
        return redirect(route('feedback'))->with('message',"Сообщение отправлено");
        
    }
    
    protected function validator(array $data)
    {
        return Validator::make($data, 
        	[
	        	'name' => 'required',
	        	'phone' => 'required',
	        	'email' => 'required|email',
            ],            
            [
           
	            'name.required' => 'укажите имя пользователя',
	            'phone.required' => 'укажите номер телефона',           
	            'email.email' => 'некорректный email',           
            ]
        )->validate();
    }
}
