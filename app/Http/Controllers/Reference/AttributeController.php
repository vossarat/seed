<?php

namespace App\Http\Controllers\Reference;

use App\Reference\Attribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttributeController extends Controller
{
	public function __construct(Attribute $attribute)
	{
		$this->attribute = $attribute;
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.elevator.attribute.index')->with([        
			'viewdata' => $this->attribute->all(),
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.elevator.attribute.create')->with([
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
        $attribute = attribute::create($request->all());
	
		return redirect(route('attribute.index'))->with([
			'message' => "Информация по атрубуту $request->name добавлена",
		]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reference\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function show(Attribute $attribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reference\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attribute = $this->attribute->find($id);
    	
        return view('dashboard.elevator.attribute.edit')->with([
			'viewdata' => $attribute,
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reference\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $attribute = $this->attribute->find($id);
		$attribute->update($request->all());	
		$attribute->save();
		return redirect(route('attribute.index'))->with('message',"Информация по атрибуту $attribute->name изменена");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reference\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attribute = $this->attribute->find($id);
        
		$attribute->delete();
		return back()->with('message',"Атрибут $attribute->name удален");
    }
}
