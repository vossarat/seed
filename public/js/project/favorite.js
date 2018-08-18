$(document).ready(function() {
        $( ".fav" ).change(function( event ) {                
                //var elevator_id = $(this).attr('id').substring(4);
                var elevator_id = {{ $elevator->id }};
                console.log( elevator_id );
            });

        
		
			
    });