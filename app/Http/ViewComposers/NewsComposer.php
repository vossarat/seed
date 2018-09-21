<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Auth;
use Func;
use App\Post;

class NewsComposer
{

    public function __construct()
    {

    }

    /**
    * Bind data to the view.
    *
    * @param  View  $view
    * @return void
    */
    public function compose(View $view)
    {       

        $view->with([
            'posts'  => Post::orderBy('id','desc')->limit(3)->get(),
        ]);
    }

}