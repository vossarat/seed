<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function show($id)
    {
    	dd($id);
        $post = $this->post->find($id);
    	
        return view('post.onepost')->with([
			'viewdata' => $post,
		]);
    }
}
