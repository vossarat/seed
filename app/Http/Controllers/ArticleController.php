<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class ArticleController extends Controller
{
    public function __construct(Post $post)
	{
		$this->post = $post;
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('post.index')->with([        
			'viewdata' => $this->post->orderBy('id','desc')->get(),
		]);
    }
    
    public function show($id)
    {
    	
        $post = $this->post->find($id);
    	
        return view('post.onepost')->with([
			'viewdata' => $post,
		]);
    }
}
