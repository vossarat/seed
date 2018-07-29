<?php

namespace App\Http\Controllers\Reference;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Reference\Country;

class CountryController extends Controller
{
	public function __construct(Country $country)
	{
		$this->country = $country;
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       	return view('dashboard.territory.country.index')->with([        
			'viewdata' => $this->country->all(),
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.territory.country.create')->with([
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
        $country = Country::create($request->all());
	
		return redirect(route('country.index'))->with([
			'message' => "Информация по стране $request->name добавлена",
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
        $country = $this->country->find($id);
    	
        return view('dashboard.territory.country.edit')->with([
			'viewdata' => $country,
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
        $country = $this->country->find($id);
		$country->update($request->all());	
		$country->save();
		return redirect(route('country.index'))->with('message',"Информация по стране $country->name изменена");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = $this->country->find($id);
        
		$country->delete();
		return back()->with('message',"Страна $country->name удалена");
    }
}
