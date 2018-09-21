<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name" class="col-md-4 control-label">
        Наименование зерновой культуры
    </label>

    <div class="col-md-6">
        <input id="name" type="text" class="form-control" name="name" value="{{ $viewdata->name or old('name') }}" required>

        @if ($errors->has('name'))
        <span class="help-block">
            <strong>
                {{ $errors->first('name') }}
            </strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group">
	<div class="{{ $errors->has('corn_id') ? ' has-error' : '' }}"> 
		
		<label for="select-gosts" class="col-md-4 control-label">ГОСТ</label>		
		
		<div class="col-md-6">
		<select id="select-gosts" multiple class="form-control" name="gosts[]" name="gosts" size="5">			
			@foreach($gosts as $item)
				@if(isset($viewdata))
					<option {{ in_array($item->id, $corn_gost )  ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
				@else
					<option value="{{ $item->id }}">{{ $item->name }}</option>
				@endif
			@endforeach			
		</select>
		</div>
	</div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
		
	$('#select-gosts').multiselect({
            buttonText: function(options, select) {
                return 'Выберите ГОСТ:';
            },
            buttonTitle: function(options, select) {
                var labels = [];
                options.each(function () {
                    labels.push($(this).text());
                });
                return labels.join(' - ');
            }
        });
		
});
</script>

@endpush               