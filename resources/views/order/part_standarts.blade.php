{{-- указать подробные параметры --}}
<div id="standarts">

<div class="form-group">
	<label class="col-md-4 control-label">Класс или сорт продукции</label>		
	<div class="col-md-8"></div>
	
	{{--
	<input type="checkbox" name="gosts[]" value="0" hidden="hidden" checked="checked">--}}
	@foreach($gosts as $gost)
	<div class="col-md-8 col-md-offset-4 text-left">
		<input class="form-check-input selected-gosts" type="checkbox" name="gosts[]" value="{{$gost->id}}" {{ in_array($gost->id, $gost_order) ? 'checked' : '' }}>{{$gost->name}}	
	</div>
	@endforeach
</div>

</div>

@push('scripts')
<script>
$(document).ready(function() {
	
	$('.selected-gosts').parent().hide();
	$.ajax({
		url: '/api/gost_by_corn/'+$('#corn_id').val(),
		success: function(gosts) {
			$.each(gosts,function(index,value){
				$('.selected-gosts[value = ' + value + ']').parent().show();
			});
		}
	});
        
    $( "#corn_id" ).change(function( event ) {
    		$('.selected-gosts').parent().hide();
			$.ajax({
				url: '/api/gost_by_corn/'+$(this).val(),
				success: function(gosts) {
					$.each(gosts,function(index,value){
						$('.selected-gosts[value = ' + value + ']').parent().show();
					});
				}
			});					

        });            
        
});
</script>
@endpush
            

