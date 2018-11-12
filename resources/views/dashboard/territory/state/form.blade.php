<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name" class="col-md-4 control-label">
        Наименование области
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