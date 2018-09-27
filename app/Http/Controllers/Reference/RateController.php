<?php

namespace App\Http\Controllers\Reference;

use App\Reference\Rate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RateController extends Controller
{
	public function __construct(Rate $rate)
	{
		$this->rate = $rate;
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reference\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function show(Rate $rate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reference\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$rate = $this->rate->find($id);    	
    	
        return view('dashboard.rate.edit')->with([        
			'viewdata' => $rate,
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reference\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd( $request->all() );
        $rate = $this->rate->find($id);
		$rate->update($request->all());	
		$rate->save();
		return redirect(route('dashboard'))->with('message',"Информация по курсам изменена");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reference\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rate $rate)
    {
        //
    }
}
