{{-- указать подробные параметры --}}

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <a href="#more-params" class="button button-effect-ujarak button-block button-default-outline" data-toggle="modal">
            Указать подробные параметры
        </a>
    </div>
</div>

<div id="more-params" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Заголовок модального окна -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
                <h4 class="modal-title">
                    Указать подробные параметры
                </h4>
            </div>
            <!-- Основное содержимое модального окна -->
            <div class="modal-body">
                
                <div class="form-group">
					<label for="classProduct" class="col-xs-12 control-label">Класс или сорт продукции</label>
					<div class="col-xs-12">
					<input type="checkbox" name="sort_standart" value="0" hidden="hidden" checked="checked">
					<input class="form-check-input" type="checkbox" name="sort_standart" value="1" id="sort_standart" {{ isset($viewdata->sort_standart) ? 'checked' : '' }} >
						<label class="form-check-label" for="sort_standart">
							Стандартное
						</label>
					</div>
					<div class="col-xs-12">
					<input type="checkbox" name="sort_other" value="0" hidden="hidden" checked="checked">
					<input class="form-check-input" type="checkbox" name="sort_other" value="1" id="sort_other" {{ isset($viewdata->sort_other) ? 'checked' : '' }} >
						<label class="form-check-label" for="sort_other">
							Другое
						</label>
					</div>
					<div class="col-xs-12">
					<input type="checkbox" name="sort_gost1" value="0" hidden="hidden" checked="checked">
					<input class="form-check-input" type="checkbox" name="sort_gost1" value="1" id="sort_gost1" {{ isset($viewdata->sort_gost1) ? 'checked' : '' }} >
						<label class="form-check-label" for="sort_gost1">
							ГОСТ 1
						</label>
					</div>
					<div class="col-xs-12">
					<input type="checkbox" name="sort_gost2" value="0" hidden="hidden" checked="checked">
					<input class="form-check-input" type="checkbox" name="sort_gost2" value="1" id="sort_gost2" {{ isset($viewdata->sort_gost2) ? 'checked' : '' }} >
						<label class="form-check-label" for="sort_gost2">
							ГОСТ 2
						</label>
					</div>
				</div> 
				
				<div class="form-group">
					<label for="classProduct" class="col-xs-12 control-label">Условия оплаты продукции</label>
					<div class="col-xs-12">
					<input type="checkbox" name="agreement" value="0" hidden="hidden" checked="checked">
					<input class="form-check-input" type="checkbox" name="agreement" value="1" id="agreement" {{ isset($viewdata->agreement) ? 'checked' : '' }} >
						<label class="form-check-label" for="agreement">
							Договорные
						</label>
					</div>
					<div class="col-xs-12">
					<input type="checkbox" name="rewrite" value="0" hidden="hidden" checked="checked">
					<input class="form-check-input" type="checkbox" name="rewrite" value="1" id="rewrite" {{ isset($viewdata->rewrite) ? 'checked' : '' }} >
						<label class="form-check-label" for="rewrite">
							По факту переписки
						</label>
					</div>
				</div>
                
                <div class="form-group">
					<div class="col-md-12">		
						<textarea class="form-control" id="notice" name="notice"  rows="3"  {{ $disabled }} placeholder="Примечание">{{ $viewdata->notice or old('notice') }}</textarea>
					</div>
				</div>
            
            </div>
            
            <!-- Футер модального окна -->
            <div class="modal-footer">
                <button type="button" class="button button-effect-ujarak button-block button-default-outline" data-dismiss="modal">
                    Разместить
                </button>
            </div>
        </div>
    </div>
</div>

