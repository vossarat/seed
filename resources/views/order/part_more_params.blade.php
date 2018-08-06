{{-- указать подробные параметры --}}

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <a href="#menu-more-params" class="button button-effect-ujarak button-block button-default-outline">
            Указать подробные параметры
        </a>
    </div>
</div>

<div id="menu-more-params" class="menu-more-params">
	<div class="form-group">
		<div class="col-md-12">
			<label><u>Класс или сорт продукции</u></label>
		</div>
		
		<div class="col-md-12">
			<label>
			<input type="checkbox" name="sort_standart" value="0" hidden="hidden" checked="checked">
			<input class="form-check-input" type="checkbox" name="sort_standart" value="1" id="sort_standart" {{ isset($viewdata->sort_standart) ? 'checked' : '' }} >			
				Стандарт
			</label>
		</div>
		
		<div class="col-md-12">
			<label>
			<input type="checkbox" name="sort_other" value="0" hidden="hidden" checked="checked">
			<input class="form-check-input" type="checkbox" name="sort_other" value="1" id="sort_other" {{ isset($viewdata->sort_other) ? 'checked' : '' }} >			
				Другое
			</label>
		</div>
		
		<div class="col-md-12">
			<label>
			<input type="checkbox" name="sort_gost1" value="0" hidden="hidden" checked="checked">
			<input class="form-check-input" type="checkbox" name="sort_gost1" value="1" id="sort_gost1" {{ isset($viewdata->sort_gost1) ? 'checked' : '' }} >			
				ГОСТ 1
			</label>
		</div>
		
		<div class="col-md-12">
			<label>
			<input type="checkbox" name="sort_gost2" value="0" hidden="hidden" checked="checked">
			<input class="form-check-input" type="checkbox" name="sort_gost2" value="1" id="sort_gost2" {{ isset($viewdata->sort_gost2) ? 'checked' : '' }} >			
				ГОСТ 2
			</label>
		</div>
		

		<div class="col-md-12">
			<label><u>Условия оплаты продукции</u></label>
		</div>
		
		<div class="col-md-12">
			<label>
			<input type="checkbox" name="agreement" value="0" hidden="hidden" checked="checked">
			<input class="form-check-input" type="checkbox" name="agreement" value="1" id="agreement" {{ isset($viewdata->agreement) ? 'checked' : '' }} >			
				Договорные
			</label>
		</div>
		
		<div class="col-md-12">
			<label>
			<input type="checkbox" name="rewrite" value="0" hidden="hidden" checked="checked">
			<input class="form-check-input" type="checkbox" name="rewrite" value="1" id="rewrite" {{ isset($viewdata->rewrite) ? 'checked' : '' }} >			
				По факту переписки
			</label>
		</div>
		
		<div class="col-md-12">
			<textarea class="form-control" id="notice" name="notice"  rows="3" placeholder="Примечание">{{ $viewdata->notice or old('notice') }}</textarea>
		</div>
		
		
	</div>
	
	
	           
</div>
            

