<?php

namespace App\Http\Controllers\Reference;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Reference\State;

class StateController extends Controller
{
	public function __construct(State $state)
	{
		$this->state = $state;
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.territory.state.index')->with([        
			'viewdata' => $this->state->all(),
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $viewdata = $this->state->find(0);
        return view('dashboard.territory.state.create')->with([
			'viewdata' => $viewdata,
			'states' => $this->state->all(),
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
        //dd( $request->all() );
        
        $state = State::create($request->all());
	
		return redirect(route('state.index'))->with([
			'message' => "Информация по области $request->name добавлена",
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $state = $this->state->find($id);
    	
        return view('dashboard.territory.state.edit')->with([
			'viewdata' => $state,
			'states' => $this->state->all(),
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
        $state = $this->state->find($id);
		$state->update($request->all());	
		$state->save();
		return redirect(route('state.index'))->with('message',"Информация по области $state->name изменена");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
