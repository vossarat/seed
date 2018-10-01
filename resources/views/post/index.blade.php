@extends('layouts.template')

@section('content')



<section class="section bg-white text-center">

<div class="shell">

    <h3>
        Новости
    </h3>
    
    @foreach($viewdata as $post)
    	<div class="row text-left news-list">    	
				<div class="row news-list-date">
		    		<span style="background-color: #f8a63d;color:#000;">	    		
		    			{{ $post->changed_at }}	    		
		    		</span>
		    	</div>

	    	<div class="row">
	    		{{ $post->title }}
	    	</div>
	    	<div class="row">
	    		<a href="{{ route('onepost', $post->id) }}">Подробнее</a>
	    	</div>
	    	<div class="divider-default"></div>
    	</div>
    	
    @endforeach
    
                
    
</div>
</section>

<section class="section bg-white text-center">

</section>

@endsection