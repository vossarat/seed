<?php

namespace App\Http\Controllers\Reference;

use App\Reference\Gost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GostController extends Controller
{
	public function __construct(Gost $gost)
	{
		$this->gost = $gost;
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.gost.index')->with([        
			'viewdata' => $this->gost->all(),
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.gost.create')->with([
			'viewdata' => [],
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
        $gost = Gost::create($request->all());
	
		return redirect(route('gost.index'))->with([
			'message' => "Информация по ГОСТ $request->name добавлена",
		]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reference\Gost  $gost
     * @return \Illuminate\Http\Response
     */
    public function show(Gost $gost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reference\Gost  $gost
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gost = $this->gost->find($id);
    	
        return view('dashboard.gost.edit')->with([
			'viewdata' => $gost,
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reference\Gost  $gost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $gost = $this->gost->find($id);
		$gost->update($request->all());	
		$gost->save();
		return redirect(route('gost.index'))->with('message',"Информация по ГОСТ $gost->name изменена");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reference\Gost  $gost
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gost $gost)
    {
        //
    }
}
