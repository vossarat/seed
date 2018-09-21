<div class="form-group">
    <label for="usd" class="col-md-4 control-label">
        USD
    </label>

    <div class="col-md-6">
        <input id="usd" type="text" class="form-control" name="usd" value="{{ $viewdata->usd or old('usd') }}" required>
    </div>
</div>  

<div class="form-group">
    <label for="eur" class="col-md-4 control-label">
        EUR
    </label>

    <div class="col-md-6">
        <input id="eur" type="text" class="form-control" name="eur" value="{{ $viewdata->eur or old('eur') }}" required>
    </div>
</div>  

<div class="form-group">
    <label for="rub" class="col-md-4 control-label">
        RUB
    </label>

    <div class="col-md-6">
        <input id="rub" type="text" class="form-control" name="rub" value="{{ $viewdata->rub or old('rub') }}" required>
    </div>
</div>              