<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
	public function __construct(User $user)
	{
		$this->user = $user;
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.user.index')->with([        
			'viewdata' => $this->user->all(),
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.user.create')->with([
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
        $requestArray = $request->all();
        $requestAddPass = array_add($requestArray, 'password', bcrypt($request->newPassword));
               
        $user = User::create($requestAddPass);        

		return redirect(route('user.index'))->with([
			'message' => "Информация по пользователю $request->name добавлена",
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
        return view('dashboard.user.show')->with([
			'viewdata' => $this->user->find($id),
			'disabled' => 'disabled',
		]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->user->find($id);
			
        return view('dashboard.user.edit')->with([
			'viewdata' => $user,
			'disabled' => '',
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
    	
    	$this->validator( $request->all() );
    	
        $validatedData = $request->validate([
	        'newPassword' => 'confirmed',
	    ]);
	    
		$user = $this->user->find($id);		
	
		$user->update($request->all());
	
		if( $request->newPassword ){
			$user->password = \Hash::make($request->newPassword);
		}		 
		
		$user->save();
		
		if($request->sms) {
			$message = "Портал www.zelenka.trade Имя:$request->name Пароль:$request->newPassword";
			$phone = preg_replace("/[^,.0-9]/", '', $request->phone);
			
			$smsRes = file_get_contents('http://smsc.kz/sys/send.php?login=Zelenka.kz&psw=espresso18return&phones='.$phone.'&mes='.$message.'&charset=utf-8&sender');
		}
	
		return redirect(route('user.index'))->with('message',"Информация по пользователю $user->name изменена");
	    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->user->find($id);
    	
		$user->delete();
		return back()->with('message',"Информация по $user->name удалена");
    }
    
    protected function validator(array $data)
    {
        return Validator::make($data, 
        	[
	        	'name' => 'required|max:255' . auth()->user()->id ,
	        	'phone' => 'required',
            ],            
            [
           
	            'name.required' => 'укажите имя пользователя',
	            'phone.required' => 'укажите номер телефона',           
	        	'max' => 'уменьшите количество символов',
            ]
        )->validate();
    }
}
