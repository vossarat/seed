$(document).ready(function() {
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
		
		$( ".order-detailed" ).hide(); // детали заявки
		$( ".toogle-order-detailed" ).click(function( event ) {
			event.preventDefault();
			var url_action =  $( this ).attr('href');		
			var order_id =  $( this ).attr('order-id');		
			$( this ).next('.order-detailed').toggle(function() {
				if($(this).is(':visible')){
					//$.ajax({ url: url_action, });
					$('#views_'+order_id).load( url_action );
				}
			});
		});
		
		
		$( ".toogle-other" ).click(function( event ) {
			event.preventDefault();
			/*if($("#elevators").is(':visible')){
				$("#elevators").hide();
			}*/
			$( "#other" ).toggle();
		});
		
		// указать подробные параметры в форме заявок 
		$("#params").hide();
		$( ".toogle-params" ).click(function( event ) {
			event.preventDefault();			
			$( "#params" ).toggle();
		});
		
		
		$( ".toogle-elevator" ).click(function( event ) {
			event.preventDefault();
			 
			$( "#elevators" ).toggle();
			if($("#other").is(':visible')){
				$("#other").hide();
			}
		});
		
		if($("a").is(".toogle-elevator-filter")) {
			$( "#elevator-filter" ).hide();
		}
		
		$( ".toogle-elevator-filter" ).click(function( event ) {
			event.preventDefault();
			$( "#elevator-filter" ).toggle();					
		});	
		
		if($("a").is(".toogle-order-filter")) {
			$( "#order-filter" ).hide();
		}
		
		$( ".toogle-order-filter" ).click(function( event ) {
			event.preventDefault();
			$( "#order-filter" ).toggle();					
		});	
		
		$("#phone").mask("+9 (999) 999-99-99", {placeholder: "" });
        $("#telegram").mask("+9 (999) 999-99-99", {placeholder: "" });
        $("#whatsapp").mask("+9 (999) 999-99-99", {placeholder: "" });
        
        
        var sel = $('.kato'),
		    cache = $('option', sel.eq(1));
		    
		sel.eq(0).on('change', function(){
			
		    var selectedColor = $(':selected',this).data('kato'),
		        filtered;

		    if(selectedColor == 'all') {
		        filtered = cache;
		    } else {
		        filtered = cache.filter(function(){
		          return $(this).data('kato') == selectedColor;
		        });
		    }
		    sel.eq(1).html(filtered).prop('selectedIndex', 0);
		});
		
		$('#select-corns').multiselect({
            buttonText: function(options, select) {
                return 'Выберите культуру:';
            },
            buttonTitle: function(options, select) {
                var labels = [];
                options.each(function () {
                    labels.push($(this).text());
                });
                return labels.join(' - ');
            }
        });
        
        $('#select-regions').multiselect({
            buttonText: function(options, select) {
                return 'Выберите район:';
            },
            buttonTitle: function(options, select) {
                var labels = [];
                options.each(function () {
                    labels.push($(this).text());
                });
                return labels.join(' - ');
            }
        });
        
       /* $("#town_id").chained("#region_id");
		$("#elevator_id").chained("#town_id");*/
	
			
    });