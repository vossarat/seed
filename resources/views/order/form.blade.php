<input type="hidden" name="user_id" value="{{ Auth::id() }}">{{-- how users = orders --}}

<div id="order-elevators" hidden>
@foreach($elevators as $elevator)
	@if( in_array( $elevator->id, $elevator_order ) )
	<input name="elevators[]" value="{{ $elevator->id }}"/>
	@endif
@endforeach
</div>

<div class="form-group">
	<div class="{{ $errors->has('corn_id') ? ' has-error' : '' }}"> 
		
		<label for="corn_id" class="col-md-4 control-label">Наименование культуры</label>		
		
		<div class="col-md-6">
		<select id="corn_id" name="corn_id" {{ $disabled }}>		
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
		<input id="count" type="text" class="form-control" name="count" placeholder= "тонн" value="{{ $viewdata->count or old('count') }}"  {{ $disabled }} >

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
		<input id="price" type="text" class="form-control" name="price" placeholder= "за тонну"  value="{{ $viewdata->price or old('price') }}"  {{ $disabled }} >

		@if ($errors->has('price'))
		<span class="help-block">
			<strong>
				{{ $errors->first('price') }}
			</strong>
		</span>
		@endif
	</div>
</div>

<div class="form-group">
	<label for="auction" class="col-md-4 control-label">Возможен торг</label>

	<div class="col-md-2">
		<label class="radio-inline">
            <input type="radio" name="auction" value="1" {{ $viewdata->auction == 1 ? 'checked' : ''}}> Да
        </label>
        <label class="radio-inline">
            <input type="radio" name="auction" value="0" {{ $viewdata->auction == 0 ? 'checked' : ''}}> Нет
        </label>

	</div>
</div>

<div class="form-group">
	<div class="{{ $errors->has('pack_id') ? ' has-error' : '' }}"> 
		
		<label for="pack_id" class="col-md-4 control-label">Упаковка</label>		
		
		<div class="col-md-6">
		<select class="" name="pack_id" {{ $disabled }}>		
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

<div class="form-group">
	<div class="{{ $errors->has('loadprice_id') ? ' has-error' : '' }}"> 
		
			
		
		<div class="col-md-6 col-md-offset-4">
		<select class="" name="loadprice_id" {{ $disabled }}>		
			@foreach($loadprices as $item)
				@if(isset($viewdata))
					<option {{ $viewdata->loadprice_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
				@else
					<option value="{{ $item->id }}">{{ $item->name }}</option>
				@endif
			@endforeach			
		</select>

		@if ($errors->has('loadprice_id'))
		<span class="help-block">
			<strong>
				{{ $errors->first('loadprice_id') }}
			</strong>
		</span>
		@endif
		</div>
	</div>
</div> 

@include('order.part_elevators') {{--отображение выбрать элеватор --}}

<div class="form-group">
	{{-- 
	<div class="col-md-3 col-md-offset-4">
		<button type="button" class="button button-effect-ujarak button-block button-default-outline toogle-elevator">
        	Выбрать элеватор
        </button>
	</div> 
	--}}
	<div class="col-md-6 col-md-offset-4">
		<button type="button" class="button button-effect-ujarak button-block button-default-outline toogle-other">
        	Указать другое
        </button>
	</div> 
</div>

{{--@include('order.part_elevators_sidebar.') отображение див для выбора элеватора--}}
@include('order.part_other') {{--отображение див для выбора другое--}}

<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
	<label for="description" class="col-md-4 control-label">Информация по месту поставки</label>

	<div class="col-md-6">		
		<textarea class="form-control" id="description" name="description"  rows="3"  {{ $disabled }} >{{ $viewdata->description or old('description') }}</textarea>

		@if ($errors->has('description'))
		<span class="help-block">
			<strong>
				{{ $errors->first('description') }}
			</strong>
		</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
	<label for="name" class="col-md-4 control-label">Имя пользователя</label>

	<div class="col-md-6">
		<input id="name" type="text" class="form-control" name="name" value="{{ isset($viewdata->user) ? $viewdata->user->name : $viewdata->name }}" {{ $disabled }} >

		@if ($errors->has('name'))
		<span class="help-block">
			<strong>
				{{ $errors->first('name') }}
			</strong>
		</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
	<label for="phone" class="col-md-4 control-label">Телефон</label>

	<div class="col-md-6">
		<input id="phone" type="text" class="form-control" name="phone" value="{{ isset($viewdata->user) ? $viewdata->user->phone : $viewdata->phone }}" {{ $disabled }} >

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
		<input id="email" type="text" class="form-control" name="email" value="{{ isset($viewdata->user) ? $viewdata->user->email : $viewdata->email }}" {{ $disabled }} >

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
		<input id="whatsapp" type="text" class="form-control" name="whatsapp" value="{{ isset($viewdata->user) ? $viewdata->user->whatsapp : $viewdata->whatsapp }}" {{ $disabled }} >

		@if ($errors->has('whatsapp'))
		<span class="help-block">
			<strong>
				{{ $errors->first('whatsapp') }}
			</strong>
		</span>
		@endif
	</div>
	@if(!$disabled)
	<div class="col-md-1 col-xs-1">
       <button id="btn-whatsapp" class="btn btn-primary"><i class="fa fa-phone"></i></button>
    </div>
	@endif
</div>

<div class="form-group{{ $errors->has('telegram') ? ' has-error' : '' }}">
	<label for="telegram" class="col-md-4 col-xs-7 control-label">Телеграм</label>

	<div class="col-md-5 col-xs-9">
		<input id="telegram" type="text" class="form-control" name="telegram" value="{{ isset($viewdata->user) ? $viewdata->user->telegram : $viewdata->telegram }}" {{ $disabled }} >

		@if ($errors->has('telegram'))
		<span class="help-block">
			<strong>
				{{ $errors->first('telegram') }}
			</strong>
		</span>
		@endif
	</div>
	@if(!$disabled)
	<div class="col-md-1 col-xs-1">
        <button id="btn-telegram" class="btn btn-primary"><i class="fa fa-phone"></i></button>
    </div>
    @endif	
</div>

{{-- старая форма отображение указать подробные параметры 
@include('order.part_more_params') 
--}}

{{--отображение указать подробные параметры --}}
<div class="form-group">
	<div class="col-md-6 col-md-offset-4">
		<button type="button" class="button button-effect-ujarak button-block button-default-outline toogle-params">
        	Указать подробные параметры
        </button>
	</div> 
</div>

@include('order.part_params') 
{{-- /отображение указать подробные параметры --}}

@push('scripts')
<script src="{{ asset('js/zepto.js') }}"></script>
<script src="{{ asset('js/zepto-selector.js') }}"></script>
<script src="{{ asset('js/jquery.chained.js') }}"></script>
<script src="{{ asset('js/project.scripts.js') }}"></script>
<script type="text/javascript">
	$(function() {
		$('div#menu-elevator').mmenu({
			extensions: ["theme-white", "border-full", "shadow-page"],
			navbar : {
				title : 'Элеваторы'
			}
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