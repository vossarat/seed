<?php

namespace App\Http\Controllers\Reference;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Reference\Corn;
use App\Reference\Gost;

class CornController extends Controller
{
	public function __construct(Corn $corn, Gost $gost)
	{
		$this->corn = $corn;
		$this->gost = $gost;
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
			'gosts' => $this->gost->all(),
			'corn_gost' => [],
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
        $corn = corn::create($request->all());
        
        $corn->gosts()->attach($request->gosts); // привязка к ГОСТ
	
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
    	
    	$corn_gost = [];
    	if(isset($corn->gosts)){
			foreach($corn->gosts->all() as $item){
				$corn_gost[] = $item->id;
			}
		}
		
        return view('dashboard.corn.edit')->with([
			'viewdata' => $corn,
			'gosts' => $this->gost->all(),
			'corn_gost' => $corn_gost,
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
		$corn->gosts()->sync($request->gosts); // привязка к ГОСТ	
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
