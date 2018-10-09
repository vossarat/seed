{{-- указать подробные параметры --}}
<div id="standarts">

<div class="form-group">
	<label class="col-md-4 control-label">Качество</label>		
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
	<label for="class_corn" class="col-md-4 control-label">Класс</label>
	<div class="col-md-6">
		<input id="class_corn" type="text" class="form-control" name="class_corn"value="{{ $viewdata->class_corn or old('class_corn') }}">
	</div>
</div>

<div class="form-group">
	<label for="notice" class="col-md-4 control-label">Доп.параметры</label>

	<div class="col-md-6">		
		<textarea class="form-control" id="notice" name="notice"  rows="3" placeholder="Укажите клейковину, влажность, белок, и другие подробные параметры">{{ $viewdata->notice or old('notice') }}</textarea>
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
            

