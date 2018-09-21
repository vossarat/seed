{{-- указать подробные параметры --}}
<div id="params">

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

<div class="form-group">
	<label class="col-md-4 control-label">Условия оплаты продукции</label>		
	<div class="col-md-8"></div>
	
	<div class="col-md-8 col-md-offset-4 text-left">
		<input type="checkbox" name="agreement" value="0" hidden="hidden" checked="checked">
		<input class="form-check-input" type="checkbox" name="agreement" value="1" id="agreement" {{ isset($viewdata->agreement) && $viewdata->agreement == 1 ? 'checked' : '' }} >			
			Договорные
	</div>
	<div class="col-md-8 col-md-offset-4 text-left">
		<input type="checkbox" name="rewrite" value="0" hidden="hidden" checked="checked">
		<input class="form-check-input" type="checkbox" name="rewrite" value="1" id="rewrite" {{ isset($viewdata->rewrite) && $viewdata->rewrite == 1 ? 'checked' : '' }} >			
			По факту переписки
	</div>	
</div>

<div class="form-group">
	<label for="notice" class="col-md-4 control-label">Примечание</label>

	<div class="col-md-6">		
		<textarea class="form-control" id="notice" name="notice"  rows="3">{{ $viewdata->notice or old('notice') }}</textarea>
	</div>
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
            

