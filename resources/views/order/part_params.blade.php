{{-- указать подробные параметры --}}
{{--
<div id="params">


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
	<label for="notice" class="col-md-4 control-label">Доп.параметры</label>

	<div class="col-md-6">		
		<textarea class="form-control" id="notice" name="notice"  rows="3" placeholder="Укажите клейковину, влажность, белок, и другие подробные параметры">{{ $viewdata->notice or old('notice') }}</textarea>
	</div>
</div> 

</div>
 --}}          

