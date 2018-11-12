<input type="hidden" name="user_id" value="{{ Auth::id() }}"/>

{{--

<div id="order-elevators" hidden>
@foreach($elevators as $elevator)
	@if( in_array( $elevator->id, $elevator_order ) )
	<input name="elevators[]" value="{{ $elevator->id }}"/>
	@endif
@endforeach
</div>
--}}

<div class="form-group" {{ $errors->has('transport_tip') ? ' has-error' : '' }}">
	
	<label for="transport_tip" class="col-md-4 control-label">Тип транспорта</label>
	
	<div class="col-md-4 text-left">
	    <label class="radio-inline">
	    	@if( isset($viewdata->transport_tip) )
	        	<input type="radio" name="transport_tip" value="1" {{ $viewdata->transport_tip == '1' ? 'checked' :  '' }}> авто
	        @else
	        	<input type="radio" name="transport_tip" value="1"> авто
	        @endif
	    </label>
	    <label class="radio-inline">
	        @if( isset($viewdata->transport_tip) )
	        	<input type="radio" name="transport_tip" value="2" {{ $viewdata->transport_tip == '2' ? 'checked' :  '' }}> вагон
	        @else
	        	<input type="radio" name="transport_tip" value="2"> ЖД
	        @endif
	    </label>
	
	@if ($errors->has('transport_tip'))
	    <span class="help-block">
	        <strong style="color:#a94442;">
	            {{ $errors->first('transport_tip') }}
	        </strong>
	    </span>
    @endif
    
	</div>
	
</div>


@include('wagon.part_elevators') {{--отображение выбрать элеватор --}}

<div class="form-group{{ $errors->has('elevator_id') ? ' has-error' : '' }}">
	<label for="elevator_id" class="col-md-4 control-label">Элеватор</label>

	<div class="col-md-6">
		<label id="lbl-elevator-name" class="control-label text-center">{{ isset($newrecord) ? 'не выбран' : $viewdata->elevator->title }}</label>
		<input id="elevator_id" type="hidden" name="elevator_id" value="{{ isset($viewdata->elevator) ? $viewdata->elevator->id : '' }}">

	</div>
</div>

<div class="form-group">
	<div class="col-md-6 col-md-offset-4">
		<button type="button" class="button button-effect-ujarak button-block button-default-outline toogle-other">
        	Указать другое
        </button>
	</div> 
</div>

@include('wagon.part_other') {{--отображение див для выбора другое--}}

<div class="form-group">
	<div class="{{ $errors->has('corn_id') ? ' has-error' : '' }}"> 
		
		<label for="corn_id" class="col-md-4 control-label">Наименование культуры</label>		
		
		<div class="col-md-6">
		<select id="corn_id" name="corn_id">		
			@foreach($corns as $item)
				@if(isset($viewdata))
					<option {{ $viewdata->corn_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
				@else
					<option value="{{ $item->id }}" gostcorn="1">{{ $item->name }}</option>
				@endif
			@endforeach			
		</select>

		@if ($errors->has('corn_id'))
		<span class="help-block">
			<strong>
				{{ $errors->first('corn_id') }}
			</strong>
		</span>
		@endif
		</div>
	</div>
</div> 

<div class="form-group{{ $errors->has('count') ? ' has-error' : '' }}">
	<label for="count" class="col-md-4 control-label">Количество (тонны)</label>

	<div class="col-md-6">
		<input id="count" type="text" class="form-control" name="count" placeholder= "тонн" value="{{ $viewdata->count or old('count') }}">

		@if ($errors->has('count'))
		<span class="help-block">
			<strong>
				{{ $errors->first('count') }}
			</strong>
		</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
	<label for="price" class="col-md-4 control-label">Цена</label>

	<div class="col-md-6">
		<input id="price" type="text" class="form-control" name="price" value="{{ $viewdata->price or old('price') }}" >

		@if ($errors->has('price'))
		<span class="help-block">
			<strong>
				{{ $errors->first('price') }}
			</strong>
		</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
	<label for="date_delivery" class="col-md-4 control-label">Срок поставки</label>

	<div class="col-md-3">
		
		<div class="input-group" id="datetimepicker2">
            
            <input id="date_delivery" type="text" class="form-control" name="date_delivery" value="{{ $viewdata->date_delivery ? $viewdata->date_delivery->format('d.m.Y') : old('date_delivery') }}" />
            <span class="input-group-addon">
                <i class="glyphicon glyphicon-calendar"></i>
            </span>
        </div>
    	@if ($errors->has('date_delivery'))
			<span class="help-block" style="color:#a94442;">
				<strong>
					{{ $errors->first('date_delivery') }}
				</strong>
			</span>
		@endif
	</div>
	
</div>

<div class="form-group">

	<div class="col-md-3 col-md-offset-4">
		<label class="radio-inline">
            <input type="radio" name="nds" value="1" {{ $viewdata->nds == 1 ? 'checked' : ''}}> с НДС
        </label>
        <label class="radio-inline">
            <input type="radio" name="nds" value="0" {{ $viewdata->nds == 0 ? 'checked' : ''}}> без НДС
        </label>

	</div>
</div>

<div class="form-group">
	<div class="{{ $errors->has('pack_id') ? ' has-error' : '' }}"> 
		
		<label for="pack_id" class="col-md-4 control-label">Упаковка</label>		
		
		<div class="col-md-6">
		<select class="" name="pack_id">		
			@foreach($packs as $item)
				@if(isset($viewdata))
					<option {{ $viewdata->pack_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
				@else
					<option value="{{ $item->id }}">{{ $item->name }}</option>
				@endif
			@endforeach			
		</select>

		@if ($errors->has('pack_id'))
		<span class="help-block">
			<strong>
				{{ $errors->first('pack_id') }}
			</strong>
		</span>
		@endif
		</div>
	</div>
</div> 

<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
	<label for="phone" class="col-md-4 control-label">Телефон</label>

	<div class="col-md-6">
		<input id="phone" type="text" class="form-control" name="phone" value="{{ isset($viewdata->user) ? $viewdata->user->phone : $viewdata->phone }}">

		@if ($errors->has('phone'))
		<span class="help-block">
			<strong>
				{{ $errors->first('phone') }}
			</strong>
		</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
	<label for="email" class="col-md-4 control-label">Email</label>

	<div class="col-md-6">
		<input id="email" type="text" class="form-control" name="email" value="{{ isset($viewdata->user) ? $viewdata->user->email : $viewdata->email }}">

		@if ($errors->has('email'))
		<span class="help-block">
			<strong>
				{{ $errors->first('email') }}
			</strong>
		</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('whatsapp') ? ' has-error' : '' }}">
	<label for="whatsapp" class="col-md-4  col-xs-7 control-label">WhatsApp</label>

	<div class="col-md-5 col-xs-9">
		<input id="whatsapp" type="text" class="form-control" name="whatsapp" value="{{ isset($viewdata->user) ? $viewdata->user->whatsapp : $viewdata->whatsapp }}">

		@if ($errors->has('whatsapp'))
		<span class="help-block">
			<strong>
				{{ $errors->first('whatsapp') }}
			</strong>
		</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('telegram') ? ' has-error' : '' }}">
	<label for="telegram" class="col-md-4 col-xs-7 control-label">Телеграм</label>

	<div class="col-md-5 col-xs-9">
		<input id="telegram" type="text" class="form-control" name="telegram" value="{{ isset($viewdata->user) ? $viewdata->user->telegram : $viewdata->telegram }}">

		@if ($errors->has('telegram'))
		<span class="help-block">
			<strong>
				{{ $errors->first('telegram') }}
			</strong>
		</span>
		@endif
	</div>
</div>

@push('scripts')
<script src="{{ asset('js/zepto.js') }}"></script>
<script src="{{ asset('js/zepto-selector.js') }}"></script>
<script src="{{ asset('js/jquery.chained.js') }}"></script>
<script src="{{ asset('js/project.scripts.js') }}"></script>
<script src="{{ asset('js/moment-with-locales.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>

 
<script type="text/javascript">
	$(function() {
		$('div#menu-elevator').mmenu({
			extensions: ["theme-white", "border-full", "shadow-page"],
			navbar : {
				title : 'Элеваторы'
			}
		});
	});
	
    $(function () {
        $('#datetimepicker2').datetimepicker({        	
      		format: 'DD.MM.YYYY',
      		locale: 'RU',
        });
        
        $('#datetimepicker2').on('changeDate', function(e){
		    $(this).datepicker('hide');
		});
    });

	/*$(function() {
		$('div#menu-more-params').mmenu({
			extensions: ["theme-white", "border-full", "shadow-page"],
			navbar : {
				title : 'Подробные параметры'
			}
		});
	});	
	
	$(function() {
		$("#menu-more-params :input").change(function() {
			inputValue = $(this).val();
			if($(this).attr('type') == 'checkbox' &&$(this).is(":checked") ) {
			    inputValue = 1;
			}; 
			if($(this).attr('type') == 'checkbox' && !$(this).is(":checked")) {
				inputValue = 0;
			}
			$( '#form-order' ).append("<input type='hidden' name='"+$(this).attr('name')+"' value='"+inputValue+"'/>");
		});		
		
	});*/
	
</script>
@endpush						