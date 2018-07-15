<?php

namespace App\Http\Controllers;

use App\Elevator;
use Illuminate\Http\Request;

class ElevatorController extends Controller
{
	public function __construct(Elevator $elevator)
	{
		$this->elevator = $elevator;
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('elevator.index')->with([        
			'viewdata' => $this->elevator->all(),
		]);
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
     * @param  \App\Elevator  $elevator
     * @return \Illuminate\Http\Response
     */
    public function show(Elevator $elevator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Elevator  $elevator
     * @return \Illuminate\Http\Response
     */
    public function edit(Elevator $elevator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Elevator  $elevator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Elevator $elevator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Elevator  $elevator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Elevator $elevator)
    {
        //
    }
}
