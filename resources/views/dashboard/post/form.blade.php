<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">
        Заголовок новости
    </label>

    <div class="col-md-10">
        <input id="title" type="text" class="form-control" name="title" value="{{ $viewdata->title or old('title') }}" required>

        @if ($errors->has('title'))
        <span class="help-block">
            <strong>
                {{ $errors->first('title') }}
            </strong>
        </span>
        @endif
    </div>
</div> 

<div class="form-group{{ $errors->has('updated_at') ? ' has-error' : '' }}">
    <label for="updated_at" class="col-md-2 control-label">
        Дата
    </label>

    <div class="col-md-2">
        <input id="changed_at" type="text" class="form-control" name="changed_at" value="{{ $viewdata->changed_at or '01.01.2018' }}" required>

        @if ($errors->has('changed_at'))
        <span class="help-block">
            <strong>
                {{ $errors->first('changed_at') }}
            </strong>
        </span>
        @endif
    </div>
</div>      

<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
	<label for="description" class="col-md-2 control-label">Подробно</label>

	<div class="col-md-10">		
		<textarea class="form-control" id="description" name="description"  rows="10">{{ $viewdata->description or old('description') }}</textarea>

		@if ($errors->has('description'))
		<span class="help-block">
			<strong>
				{{ $errors->first('description') }}
			</strong>
		</span>
		@endif
	</div>
</div>

@push('scripts')
<script type="text/javascript">

$(document).ready(function() {

    $('#description').summernote();

});

</script>
@endpush        