<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="col-md-4 control-label">{{ 'User Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="user_id" type="number" id="user_id" value="{{ $seguir->user_id or ''}}" >
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('user_id_seguido') ? 'has-error' : ''}}">
    <label for="user_id_seguido" class="col-md-4 control-label">{{ 'User Id Seguido' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="user_id_seguido" type="number" id="user_id_seguido" value="{{ $seguir->user_id_seguido or ''}}" >
        {!! $errors->first('user_id_seguido', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Cadastrar' }}">
    </div>
</div>
