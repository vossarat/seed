$(document).ready(function() {
        $("#phone").mask("+9 (999) 999-99-99", {placeholder: "" });
        $("#telegram").mask("+9 (999) 999-99-99", {placeholder: "" });
        $("#whatsapp").mask("+9 (999) 999-99-99", {placeholder: "" });

        $( "#btn-telegram" ).click(function( event ) {
                event.preventDefault();
                $("#telegram").val( $("#phone").val() );
            });

        $( "#btn-telegram" ).click(function( event ) {
                event.preventDefault();
                $("#telegram").val( $("#phone").val() );
            });

        $( "#btn-whatsapp" ).click(function( event ) {
                event.preventDefault();
                $("#whatsapp").val( $("#phone").val() );
            });
	
		$( "#elevators" ).hide();
		$( "#other" ).hide();
		
		$( ".toogle-other" ).click(function( event ) {
			event.preventDefault();
			if($("#elevators").is(':visible')){
				$("#elevators").hide();
			}
			$( "#other" ).toggle();
		});
		
		$( ".toogle-elevator" ).click(function( event ) {
			event.preventDefault();
			$( "#elevators" ).toggle();
			if($("#other").is(':visible')){
				$("#other").hide();
			}
		});
		
		$("#town_id").chained("#region_id");
		$("#elevator_id").chained("#town_id");
		
			
    });