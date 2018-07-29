<?php

namespace App\Http\Controllers\Reference;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Reference\Corn;

class CornController extends Controller
{
	public function __construct(Corn $corn)
	{
		$this->corn = $corn;
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       	return view('dashboard.corn.index')->with([        
			'viewdata' => $this->corn->all(),
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$viewdata = $this->corn->find(0);
        return view('dashboard.corn.create')->with([
			'viewdata' => $viewdata,
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
        $region = corn::create($request->all());
	
		return redirect(route('corn.index'))->with([
			'message' => "Информация по зерновой культуре $request->name добавлена",
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
        $corn = $this->corn->find($id);
    	
        return view('dashboard.corn.edit')->with([
			'viewdata' => $corn,
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
        $corn = $this->corn->find($id);
		$corn->update($request->all());	
		$corn->save();
		return redirect(route('corn.index'))->with('message',"Информация по зерновой культуре $corn->name изменена");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $corn = $this->corn->find($id);
        
		$corn->delete();
		return back()->with('message',"Зерновая культура $corn->name удален");
    }
}
