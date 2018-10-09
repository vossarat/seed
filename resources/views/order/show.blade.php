<section class="section section-lg bg-white text-center">
    <div class="shell">
        <div class="range range-xs-center range-60 range-lg-200">
            <div class="cell-xs-12">

                <div class="block-left">
					
					<h2>Ваша заявка</h2>

                     <p class="text-left">

                        <label>
                            Наименование культуры:
                        </label>

                        <label id="lbl-corn">
                            Арахис
                        </label>
                    </p>
                    
                     <p class="text-left">
                        <label>Количество (тонны):</label>
                        <label id="lbl-count"></label>
                    </p>
                    
                    <p class="text-left"> 
                        <label>Цена:</label>
                        <label id="lbl-price"></label>
                    </p>
                    
                    {{--
                    <p class="text-left"> 
                        <label>Стандартизация:</label>
                        <label id="lbl-standart"></label>
                    </p>
                    --}}
                </div>
            </div>
        </div>
    </div>

</section>

@push('scripts')
<script type="text/javascript">

$(document).ready(function() {
	
	$( "#lbl-corn" ).text( $("#corn_id option:selected").text() )
	$( "#corn_id" ).change(function( event ) {
		$( "#lbl-corn" ).text( $("#corn_id option:selected").text() );
		
    });   
    
    $( "#lbl-count" ).text( $( "#count" ).val() + " тонн" );
    $( "#count" ).change(function( event ) {
		$( "#lbl-count" ).text( $( this ).val() + " тонн" );
		
    }); 
    
    $( "#lbl-price" ).text( $( "#price" ).val() + " тенге" );
    $( "#price" ).change(function( event ) {
		$( "#lbl-price" ).text( $( this ).val() + " тенге"  );
		
    });   
    
	/*$('.selected-gosts').click(function() {
		if ( $( this ).prop("checked") ) {
			$( "#lbl-standart" ).text( $( this ).parent().text() );
		}
	});*/
	
	$('body').on('click', '.selected-gosts', function() {
		selected_gosts = $('.selected-gosts input:checkbox:checked');
		//console.log( selected_gosts );
		console.log( 'selected_gosts '+selected_gosts.length );
		selected_gosts.each(function (index, value) { 
			console.log('selected_gosts' + index + ':' + $(this).parent().text()); 
		});
		/*if ( $( this ).prop("checked") ) {
			$( "#lbl-standart" ).text( $( this ).parent().text() );
		}*/
	});
    
    /*$("input:checkbox:checked")
    $( ".se" ).change(function( event ) {
		$( "#lbl-standart" ).text( $( this ).val() + " тенге"  );
		
    }); */    
	

});
	
</script>
@endpush